<?php

namespace App\Http\Controllers;

use App\orders;
use Illuminate\Http\Request;

class OrdersReportController extends Controller
{
     public function index()
    {
    return view('reports.orders_report');
    }

    public function search_orders(Request $request){

        $rdio = $request->rdio;
    
     // في حالة البحث بنوع حالة الدفع
        
        if ($rdio == 1) {    
           
     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                
               $orders = orders::select('*')->where('OrderStatus','=',$request->type)->get();
               $type = $request->type;
               return view('reports.orders_report',compact('type'))->withDetails($orders);
            }
            
            // في حالة تحديد تاريخ تسليم
            else {
               
              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $type = $request->type;              
              $orders = orders::whereBetween('order_Date',[$start_at,$end_at])->where('OrderStatus','=',$request->type)->get();
              return view('reports.orders_report',compact('type','start_at','end_at'))->withDetails($orders);
              
            }
    
     
            
        } 
        
    //====================================================================
        
    // في البحث برقم الفاتورة
        else {
            
            $orders = orders::select('*')->where('order_number','=',$request->order_number)->get();
            return view('reports.orders_report')->withDetails($orders);
            
        }
    
        
         
        }
}



