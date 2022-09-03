<?php

namespace App\Http\Controllers;

use App\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitsReportController extends Controller
{
  
   public function index()
   {
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

      return view('reports.profits_report', compact('allOrders','total'));
    
   }
   public function search_profits(Request $request)
   {
      
         $start_at = date($request->start_at);
         $end_at = date($request->end_at);
         $percent = 0.1;
         $query = orders::where([
            ['Value_PaymentStatus', '=', 1]
         ])
        ->whereBetween('order_Date',[$start_at,$end_at])
         ->select(
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
            "user",
            "note",
            "Payment_Date"
         );
         $allOrders = $query->get();
         $allOrdersArr = $allOrders->toArray();
         $total = 0;

         foreach ($allOrdersArr as $item) {
            $total += $item['amount'];
         }
         return view('reports.profits_report', compact('allOrders','total'));  
         return view('home', compact('total'));   
      }
   
}
