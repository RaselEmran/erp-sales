<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Supplier;
use App\Expense;
use App\Product;

class ReportController extends Controller
{
   public function supplier()
   {
   	return view('admin.report.supplierreport');
   }

   public function singlesuppdetails($id)
   {
   	$single =DB::table('purchases')->where('supplier_name',$id)->get();
   	return view('admin.report.singlesuppdetails',compact('id','single'));
   }

   public function client()
   {
   	return view('admin.report.clientreport');

   }

   public function singleclientreport($id)
   {
   	 $single =DB::table('pos')->where('customer_name',$id)->get();
   	return view('admin.report.singleclientdetails',compact('id','single'));
   }

   public function sellsreport()
   {
   	// $sell =DB::table('pos')
   	//       ->join('clients', 'pos.customer_name', '=', 'clients.id')
    //       ->select('pos.*', 'clients.name as cus_name')
   	//       ->get();
   	// $paid =DB::table('pos')->sum('paid');
   	// $due =DB::table('pos')->sum('due');
   	return view('admin.report.sellsreport');
   }

   public function rng_sellsreport(Request $request)
   {
    $start =$request->start;
    $end =$request->end;
        $sell =DB::table('pos')
          ->join('clients', 'pos.customer_name', '=', 'clients.id')
          ->where('pos.pos_date','>=',$start)
          ->where('pos.pos_date','<=',$end)
          ->select('pos.*', 'clients.name as cus_name')
          ->get();
        return view('admin.report.sellsreport',compact('sell'));

   }

   public function expensereport()
   {
      // $expense =Expense::all();
      // $amt =DB::table('expenses')->sum('amount');
     	// $paid =DB::table('expenses')->sum('paid');
     	return view('admin.report.expensereport');
   }

   public function rng_expensereport(Request $request)
   {
    $start =$request->start;
    $end =$request->end;
    $expense =Expense::where('date','>=',$start)->where('date','<=',$end)->get();
    return view('admin.report.expensereport',compact('expense'));

   }

   public function todaysreport()
   {
   	$date =date('m/d/Y');
   	$pos =DB::table('pos')->where('pos_date',$date)->sum('paid');
   	$expenses =DB::table('expenses')->where('date',$date)->sum('paid');
   	$purchases =DB::table('purchases')->where('supp_date',$date)->sum('total');

   	return view('admin.report.todaysreport',compact('pos','expenses','purchases'));
   }

   public function stockreport()
   {
    $product =Product::where('status',1)->get();
    return view('admin.report.stock',compact('product'));
   }
}
