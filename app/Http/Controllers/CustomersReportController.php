<?php

namespace App\Http\Controllers;
use App\orders;
use App\services;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersReportController extends Controller
{
   public function index()
   {
      $providers = User::select('*')->where('roles_name','["provider"]')->get();
      return view('reports.customers_report', compact('providers'));
   }

   public function search_customers(Request $request)
   {
     
      $id = $request->provider_id;
      $user = User::find($id);  
      $percent = 0.9;
      $query = orders::with('service')
      ->whereHas('service', function ($q) use ($id) {
         $q->where('service_provider_id',$id);
       })
      ->where([
         ['Value_PaymentStatus', '=', 1]
      ])->select(
         DB::raw("$percent* Amount_collection as amount"),
         "order_number",
         "order_Date",
         "Due_Date",
         "service_id",
         "section_id",
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
    return view('reports.customers',compact('allOrders','total','user'));
    
   

   }
}
