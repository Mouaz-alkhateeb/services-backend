<?php

namespace App\Http\Controllers;

use App\ArchiveOrder;
use App\orders;
use Illuminate\Http\Request;

class ArchiveOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = orders::onlyTrashed()->get();
        return view('orders.Archive_Orders',compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArchiveOrder  $archiveOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ArchiveOrder $archiveOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArchiveOrder  $archiveOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchiveOrder $archiveOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArchiveOrder  $archiveOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->order_id;
        $flight = orders::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_order');
        return redirect('/orders'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $orders = orders::withTrashed()->where('id',$request->order_id)->first();
        $orders->forceDelete();
        session()->flash('delete_order');
        return redirect('/Archive');
    
    }
}