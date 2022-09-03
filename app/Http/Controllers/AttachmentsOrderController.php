<?php

namespace App\Http\Controllers;

use App\Attachments_order;
use App\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            ]);
            
            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
    
            $attachments =  new Attachments_order();
            $attachments->file_name = $file_name;
            $attachments->order_number = $request->order_number;
            $attachments->order_id = $request->order_id;
            $attachments->Created_by = Auth::user()->name;
            $attachments->save();
               
            // move pic
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/'. $request->order_number), $imageName);
            
            session()->flash('Add', 'تم اضافة المرفق بنجاح');
            return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Attachments_order  $attachments_order
     * @return \Illuminate\Http\Response
     */
    public function show(Attachments_order $attachments_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attachments_order  $attachments_order
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attachments_order  $attachments_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachments_order $attachments_order)
    {
        //
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachments_order  $attachments_order
     * @return \Illuminate\Http\Response
     */

}
