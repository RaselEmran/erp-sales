<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\Pos;
use App\Client;
use App\Due_info;
use DB;

class PosController extends Controller
{
   public function index()
   {
   	$pos= DB::table('pos')
            ->join('clients', 'pos.customer_name', '=', 'clients.id')
            ->select('pos.*', 'clients.name as cus_name')
            ->get();
   	return view('admin.pos.index',compact('pos'));
   }

   public function create()
   {
   	return view('admin.pos.create');
   }

   public function append(Request $request)
   {

   	 $product =Product::find($request->product);

   	  $res ='<tr>';
   	  $res.='<td><input type="text" name="product_name[]" value="'.$product->name.'" readonly/><input type="hidden" name="pid[]" value="'.$product->id.'" readonly/><input type="hidden" name="code[]" value="'.$product->code.'" readonly/></td>';
   	  $res.='<td><input type="text" name="price[]" class="price" id="price" value="'.$product->price.'"readonly/></td>';
   	  $res.='<td><input type="text" name="qty[]" class="qty" id="qty" value="1"/><input type="hidden" name="tqty[]" class="tqty" id="tqty" value="'.$product->stock.'"/></td>';
   	  $res.='<td><span class="amt" >'.$product->price.'</span></td>';
   	  $res.='<td><button type="button" name="remove" class="btn btn-danger btn-sm remmove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
   	  return $res;
   }

   public function store(Request $request)
   {
 
       $this->validate($request, [
           'customer_name' =>'required',
           'pos_date'=>'required',

       ]);
     if ($request->sub_total ==0) {
    return Redirect::to('admin/pos/create')->with('msg','sub total value is not sufficiant');
     }
     else{
   	$product_name= $request->product_name;
      $pid= $request->pid;
      $price= $request->price;
      $qty= $request->qty;
      $code= $request->code;
      $tqty =$request->tqty;       
      $data=array();
      $data['customer_name']= $request->customer_name;
      $data['pos_date']= $request->pos_date;
      $data['sub_total']= $request->sub_total;
      $data['vat']= $request->vat;
      $data['vatvalue']= $request->vatvalue;

      $data['discount']= $request->discount;
      $data['percent']= $request->percent;
      $data['percent_amt']= $request->percent_amt;      
      $data['net_total']= $request->net_total;
      $data['paid']= $request->paid;
      $data['due']= $request->due;
      $data['status']= $request->status;
      DB::table('pos')->insert($data);

      $sell_id = DB::getPdo()->lastInsertId();
      $due_info= new Due_info();
      $due_info->invoice_id =$sell_id;
      $due_info->net_total =$request->net_total;
      $due_info->pay_amt =$request->paid;
      $due_info->due_amt =$request->due;
      $due_info->date =$request->pos_date;
      $due_info->save();

      for ($i=0; $i <count($pid) ; $i++) {
       $rem_qty =$tqty[$i] -$qty[$i];
       $product =Product::find($pid[$i]);
       $product->stock=$rem_qty;
       $product->save();
      	$d =array();
      	$d['pos_id'] =$sell_id;
      	$d['product_id'] =$pid[$i];
        $d['code'] =$code[$i];
      	$d['product_name']=$product_name[$i];
      	$d['qty']=$qty[$i];
      	$d['price']=$price[$i];
      	DB::table('pos_details')->insert($d);

      }
       return Redirect::to('admin/pos/pos-print');
    }
   }

      public function cnannerstore(Request $request)
   {
      $this->validate($request, [
           'customer_name' =>'required',
           'pos_date'=>'required',

       ]);
 
     if ($request->sub_total ==0) {
    return Redirect::to('admin/pos/scanner')->with('msg','sub total value is not sufficiant');
     }
     else{
    $product_name= $request->product_name;
      $pid= $request->pid;
      $price= $request->price;
      $qty= $request->qty;
      $code= $request->code;
      $tqty =$request->tqty;

       
      $data=array();
      $data['customer_name']= $request->customer_name;
      $data['pos_date']= $request->pos_date;
      $data['sub_total']= $request->sub_total;
      $data['vat']= $request->vat;
      $data['vatvalue']= $request->vatvalue;
      $data['discount']= $request->discount;
      $data['percent']= $request->percent;
      $data['percent_amt']= $request->percent_amt;   
      $data['net_total']= $request->net_total;
      $data['paid']= $request->paid;
      $data['due']= $request->due;
      $data['status']= $request->status;
      DB::table('pos')->insert($data);

      $sell_id = DB::getPdo()->lastInsertId();
      $due_info= new Due_info();
      $due_info->invoice_id =$sell_id;
      $due_info->net_total =$request->net_total;
      $due_info->pay_amt =$request->paid;
      $due_info->due_amt =$request->due;
      $due_info->date =$request->pos_date;
      $due_info->save();

      for ($i=0; $i <count($pid) ; $i++) {
       $rem_qty =$tqty[$i] -$qty[$i];
       $product =Product::find($pid[$i]);
       $product->stock=$rem_qty;
       $product->save();
        $d =array();
        $d['pos_id'] =$sell_id;
        $d['product_id'] =$pid[$i];
        $d['code'] =$code[$i];
        $d['product_name']=$product_name[$i];
        $d['qty']=$qty[$i];
        $d['price']=$price[$i];
        DB::table('pos_details')->insert($d);

      }
       return Redirect::to('admin/pos/pos-print');
    }
   }

   public function edit($id)
   {

   	     $pos =Pos::find($id);
         $b =$pos->customer_name;
         $custom =Client::find($b);
         $details =DB::table('pos_details')
                    ->where('pos_id',$id)
                    ->get();
   	return view('admin.pos.edit',compact('pos','custom','details'));
   }

   public function update(Request $request,$id)
   {
    if ($request->sub_total ==0) {
    return Redirect::to('/admin/sell')->with('sms','sub total value is not sufficiant');
     }
     {
   	$details =DB::table('pos_details')->where('pos_id', '=', $id)->delete();

   	if ($details) {
   	  $product_name= $request->product_name;
      $pid= $request->pid;
      $price= $request->price;
      $qty= $request->qty;
      $code= $request->code;
      $h_qty =$request->h_qty;
      $pay =$request->paid+$request->new_pay;
      $data=array();
      $data['customer_name']= $request->customer_name;
      $data['pos_date']= $request->pos_date;
      $data['sub_total']= $request->sub_total;
      $data['discount']= $request->discount;
      $data['percent']= $request->percent;
      $data['percent_amt']= $request->percent_amt;   
      $data['net_total']= $request->net_total;
      $data['paid']= $pay;
      $data['due']= $request->due;
      $data['status']= $request->status;
      DB::table('pos')
           ->where('id', $id)
           ->update($data);

      $due_info= new Due_info();
      $due_info->invoice_id =$id;
      $due_info->net_total =$request->net_total;
      $due_info->pay_amt =$request->new_pay;
      $due_info->due_amt =$request->due;
      $due_info->date =$request->pos_date;
      $due_info->save();
      
        for ($i=0; $i <count($pid) ; $i++) {
        $product =Product::find($pid[$i]);
        $a =$product->stock;
        if ($h_qty !=null) {
          $b=$a+$h_qty[$i];
        }
        else
        {
          $b=$a+0;
        }
        $product->stock=$b;
        $still=$product->save();
        if ($still) {
          $rempro=Product::find($pid[$i]);
          $c=$rempro->stock;
          $rem=$c-$qty[$i];
          $rempro->stock=$rem;
          $rempro->save();
        }


      	$d =array();
      	$d['pos_id'] =$id;
      	$d['product_id'] =$pid[$i];
        $d['code'] =$code[$i];
      	$d['product_name']=$product_name[$i];
      	$d['qty']=$qty[$i];
      	$d['price']=$price[$i];
      	DB::table('pos_details')->insert($d);

      }     
   	}
   	 $pos =Pos::find($id);
      $b =$pos->customer_name;
      $customer =Client::find($b);
      $details =DB::table('pos_details')
                    ->where('pos_id',$id)
                    ->get();
   	 return view('admin.pos.editprint',compact('pos','customer','details'));
      }
   }

   public function delete($id)
   {
   	$pos =Pos::find($id);
   	$a =$pos->delete();
   	if ($a) {
   		$d=DB::table('pos_details')->where('pos_id', '=', $id)->delete();
   	}
   	return Redirect::to('admin/sell');
   }

   public function scanner()
   {
    return view('admin.pos.scanner');
   }

   public function scannerappend(Request $request)
   {
    $row = $request->row;
    $res =Product::where('code',$request->product)->first();
    if ($res) {
    return response()->json(['status'=>true,'product'=>$res]);
    }
    else
    {
      return response()->json(['status'=>false]);
    }
   }

     public function scannerappend1(Request $request)
   {
    $row = $request->row;
    $res =Product::where('code',$request->product)->first();
    if ($res) {
    return view('admin.pos.scannitem',compact('res', 'row'));
    }
    else
    {
      return '<span class="notfound">Product Not found</span>';
    }
   }
}
