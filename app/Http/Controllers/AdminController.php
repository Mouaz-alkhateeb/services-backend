<?php

namespace App\Http\Controllers;

use App\orders;
use App\services;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        //هاد التابع مشان ما اقدر فوت عرابط الادمن بدون مصادقة وبدون ماكون ادمن
        //$this->middleware(['auth', 'role:owner']);
    }
    public function index(){
        $percent = 0.1;
        $query = orders::where([
           ['Value_PaymentStatus', '=', 1]
        ])->select(
           DB::raw("$percent* Amount_collection as amount"),
           "order_number",
           "order_Date",
           "Due_Date",
           "service_id",
           "section_id",
           "Amount_collection",
           "Amount_collection",
           "OrderStatus",
           "Value_OrderStatus",
           "PaymentStatus",
           "Value_PaymentStatus",
           "note",
           "Payment_Date"
        );
        $allOrders = $query->get();
        $allOrdersArr = $allOrders->toArray();
        $total = 0;
  
        foreach ($allOrdersArr as $item) {
           $total += $item['amount'];
        }
        $users=User::count();
        $services=services::select('*')->where('status','=','فعالة')->count();
        $providers = User::select('*')->where('roles_name', '["provider"]')->count();
        $orders=orders::count();
        $Fullfilled_orders=orders::where('Value_OrderStatus',1)->count();    
        $Partially_Fullfilled_Orders=orders::where('Value_OrderStatus',2)->count();
        $UnFullfilled_Orders=orders::where('Value_OrderStatus',3)->count();

        $nspa1 = round(($orders != 0) ? ($Fullfilled_orders / $orders * 100) : 0);
        $nspa2 = round(($orders != 0) ? ($Partially_Fullfilled_Orders / $orders * 100) : 0);
        $nspa3 = round(($orders != 0) ? ($UnFullfilled_Orders / $orders * 100) : 0);
       


        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['النسبة المئوية'])
        ->datasets([
            [
                "label" => "الطلبات الكلية",
                'backgroundColor' => ['#4D96FF'],
                'data' => [100]
            ],
            [
                "label" => " الطلبات المنفذة ",
                'backgroundColor' => ['#FD5D5D'],
                'data' => [$nspa1]
            ],
            [
                "label" => "الطلبات قيد التنفيذ  ",
                'backgroundColor' => ['#EA5C2B'],
                'data' => [$nspa2]
            ],
            [
                "label" => " الطلبات الغير منفذة ",
                'backgroundColor' => ['#019267'],
                'data' => [$nspa3]
            ],
           
        ])
        ->options([]);
        
        $chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 340, 'height' => 200])
        ->labels(['الطلبات قيد التنفيذ', 'الطلبات المنفذة ','الطلبات غير المنفذة   '])
        ->datasets([
            [
                'backgroundColor' => ['#019267','#FD5D5D','#EA5C2B'],
                'data' => [$nspa2,$nspa1 ,$nspa3]
            ]
        ])
        ->options([]);


        return view('home', compact('total','users','services','providers','orders','Fullfilled_orders','UnFullfilled_Orders','Partially_Fullfilled_Orders','nspa1','nspa2','nspa3','chartjs','chartjs2'));
    }

    public function index2(){
        return view('landing');
    }
    
    public function approval($id)
    {
       $service=services::find($id);
       $service->provider->roles_name=["provider"];       
       $service->provider->save();
       $service->status='فعالة';
       $service->value_status='1';
       $service->save();
       return back();
    }
    public function cancel($id)
    {
        $service = services::findOrFail($id);
        $service->delete();
        return redirect('/services');
    }
}
 