<?php

namespace App\Http\Controllers;

use App\Attachments_order;
use App\orders;
use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\ordersExport;
use App\Notifications\Add_order;
use App\services;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = orders::all();
        $sections = sections::all();
        return view('orders.orders', compact('orders','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::whereNotNull('parent_id')->get();
        $services = services::all();
        return view('orders.add_order',compact('sections','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uuid = Str::uuid()->toString();
        orders::create([
            'order_number' => $uuid,
            'order_Date' => $request->order_Date,  
            'Due_Date' => $request->Due_Date, 
            'service_id' => $request->service_id,  
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'OrderStatus' => 'معلق ',
            'Value_OrderStatus' => 0,
            'PaymentStatus' => 'غير مدفوع',
            'Value_PaymentStatus' =>3,       
            'customer_id' => (Auth::user()->id),
            'note' => $request->note,
        ]);
        if ($request->hasFile('pic')) {

            $order_id = orders::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $order_number = $request->order_number;
            $attachments = new Attachments_order();
            $attachments->file_name = $file_name;
            $attachments->order_number = $order_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->order_id = $order_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $order_number), $imageName);
        }
        $user = User::get();  
        $orders=orders::latest()->first();
        Notification::send($user, new Add_order($orders));
        session()->flash('Add', 'تم اضافة الطلب بنجاح');
        return redirect('/orders');  
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $order = orders::where('id',$id)->first();
        $attachments  = Attachments_order::where('order_id',$id)->get();
        return view('orders.details_order',compact('attachments','order'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orders=orders::where('id',$id)->first();
        $sections=sections::all();
        return view('orders.edit_order',compact('orders','sections'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orders = orders::findOrFail($request->order_id);
        $orders->update([
            
            'order_Date' => $request->order_Date,
            'Due_Date' => $request->Due_Date,
            'Amount_collection' => $request->Amount_collection,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الطلب بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->order_id;
        $orders = orders::where('id', $id)->first();
        $Details = Attachments_order::where('order_id', $id)->first();
        $id_page =$request->id_page;
        if (!$id_page==2) {
        if (!empty($Details->order_number)) 
        {
            Storage::disk('public_uploads')->deleteDirectory($Details->order_number);
        }
        $orders->forceDelete();
        session()->flash('delete_order');
        return redirect('/orders');
        }
        else {

            $orders->delete();
            session()->flash('archive_order');
            return redirect('/orders');
        }
    }
    public function getservices($id)
    {
        $services = DB::table("services")->where('section_id', $id)->pluck('name','id');      
        return json_encode($services);  
    }
    public function destroyfile(Request $request)
    {
        $order = Attachments_order::findOrFail($request->id_file);
        $order->delete();
        Storage::disk('public_uploads')->delete($request->order_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();  
    }
    public function open_file($order_number,$file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($order_number.'/'.$file_name);
        return response()->file($files);
    }
    public function download_file($order_number,$file_name)
    {
        $down = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($order_number.'/'.$file_name);
        return response()->download($down);
    }
    public function status_show($id)
    {
       $orders=orders::where('id',$id)->first(); 
       return view('orders.status_update',compact('orders'));
    }
    public function status_update($id ,Request $request)
    {
        $orders = orders::findOrFail($id);
        if ($request->PaymentStatus === 'مدفوع' && $request->OrderStatus === 'منفذ')
         {
            $orders->update([
                'Value_PaymentStatus' => 1,
                'Value_OrderStatus' => 1,
                'PaymentStatus' => $request->PaymentStatus,
                'OrderStatus' => $request->OrderStatus,
                'Payment_Date' => $request->Payment_Date, 
            ]);
        }
        else
        {
            $orders->update([
                'Value_PaymentStatus' => 2,
                'Value_OrderStatus' =>2,
                'PaymentStatus' => $request->PaymentStatus,
                'OrderStatus' => $request->OrderStatus,
                'Payment_Date' => $request->Payment_Date,
            ]); 
        }
        session()->flash('status_update');
        return redirect('/orders');

    }
    public function Fullfilled_Orders()
    {
       $orders=orders::where('Value_OrderStatus',1)->get();
       return view('orders.Fullfilled_Orders',compact('orders'));
    }
    public function Partially_Fullfilled_Orders()
    {
       $orders=orders::where('Value_OrderStatus',2)->get();
       return view('orders.Partially_Fullfilled_Orders',compact('orders'));
    }
    public function UnFullfilled_Orders()
    {
       $orders=orders::where('Value_OrderStatus',3)->get();
       return view('orders.UnFullfilled_Orders',compact('orders'));
    }
    
    public function export()
    {
       return Excel::download(new OrdersExport, 'orders.xlsx');
    }
    public function ApprovalOrder($id)
    {
       $data=orders::find($id);
       $data->OrderStatus='غير منفذ';
       $data->Value_OrderStatus='3';
       $data->save();
       return back();
    }
    public function CancelOrder($id)
    {
        $service = orders::findOrFail($id);
        $service->delete();
        return redirect('/services');
    }
}
