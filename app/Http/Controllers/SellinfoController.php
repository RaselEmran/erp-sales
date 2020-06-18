<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pos;
use App\Client;
use DB;
class SellinfoController extends Controller
{
    public function due()
    {
    	$pos =Pos::where('due','>',0)->get();
    	return view('admin.sellinfo.due',compact('pos'));
    }

    public function editdue($id)
    {
    	 $pos =Pos::find($id);
         $b =$pos->customer_name;
         $custom =Client::find($b);
         $details =DB::table('pos_details')
                    ->where('pos_id',$id)
                    ->get();
   	return view('admin.sellinfo.paiddue',compact('pos','custom','details'));
    }

    public function paid()
    {
      $pos =Pos::where('due','=',0)->get();
      return view('admin.sellinfo.payinfo',compact('pos'));
        
    }

        public function invoice($id)
    {
      $pos =Pos::find($id);
      $b =$pos->customer_name;
      $customer =Client::find($b);
      $details =DB::table('pos_details')
                    ->where('pos_id',$id)
                    ->get();

       return view('admin.sellinfo.invoice',compact('pos','customer','details'));              
    }
}
