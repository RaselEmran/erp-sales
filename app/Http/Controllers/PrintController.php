<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pos;
use App\Client;
use App\Purchase;
use App\Supplier;
use DB;
class PrintController extends Controller
{
    public function print()
    {
     $pos =DB::table('pos')
              ->orderby('id' , 'desc')
              ->first();
      $a =$pos->id;
      $b =$pos->customer_name;
      $customer =DB::table('clients')
               ->where('id', $b)->first();
      $details =DB::table('pos_details')
                    ->where('pos_id',$a)
                    ->get();
     return view('admin.pos.print',compact('pos','customer','details'));                       
    }

    public function invoice($id)
    {
      $pos =Pos::find($id);
      $b =$pos->customer_name;
      $customer =Client::find($b);
      $details =DB::table('pos_details')
                    ->where('pos_id',$id)
                    ->get();

       return view('admin.pos.invoice',compact('pos','customer','details'));              
    }

    public function purchaseprint()
    {

     $purchases =DB::table('purchases')
              ->orderby('id' , 'desc')
              ->first();
      $a =$purchases->id;
      $b =$purchases->supplier_name;
      $supplier =DB::table('suppliers')
               ->where('id', $b)->first();
      $details =DB::table('purchase_details')
                    ->where('invo_id',$a)
                    ->get();
     return view('admin.purchase.print',compact('purchases','supplier','details')); 
    }

    public function purchaseinvoice($id)
    {
        $purchases =Purchase::find($id);
      $b =$purchases->supplier_name;
      $supplier =Supplier::find($b);
      $details =DB::table('purchase_details')
                    ->where('invo_id',$id)
                    ->get();
     return view('admin.purchase.invoice',compact('purchases','supplier','details'));
    }

    public function invoice_print($id)
    {
      $pos =Pos::find($id);
      $b =$pos->customer_name;
      $customer =Client::find($b);
      $details =DB::table('pos_details')
                    ->where('pos_id',$id)
                    ->get();

       return view('admin.pos.invoice_print',compact('pos','customer','details')); 
    }
}
