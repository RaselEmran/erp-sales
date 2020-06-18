<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Product;
use App\Purchase;
use App\Supplier;
use DB;

class PurchaseController extends Controller
{
    public function index()
    {
      $purchase = DB::table('purchases')
            ->join('suppliers', 'purchases.supplier_name', '=', 'suppliers.id')
            ->select('purchases.*', 'suppliers.name as supp_name')
            ->get();
    	return view('admin.purchase.index',compact('purchase'));
    }

    public function create()
    {
    	return view('admin.purchase.create');
    }

    public function product(Request $request)
    {
    	$id =$request->pid;
        $product =Product::find($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
      $product_name= $request->product_name;
      $product_id= $request->product_id;
      $price= $request->price;
      $qty= $request->qty;
       
      $data=array();
      $data['supplier_name']= $request->supplier_name;
      $data['supp_date']= $request->supp_date;
      $data['total']= $request->total;
      $data['status']= $request->status;
      DB::table('purchases')->insert($data);

      $invo_id = DB::getPdo()->lastInsertId();

      for ($i=0; $i <count($product_id) ; $i++) { 
      	$d =array();
      	$d['invo_id'] =$invo_id;
      	$d['product_id'] =$product_id[$i];
      	$d['product_name']=$product_name[$i];
      	$d['qty']=$qty[$i];
      	$d['price']=$price[$i];
      	DB::table('purchase_details')->insert($d);

      }
      return Redirect::to('admin/purchase/purchase-print');
    }

       public function edit($id)
   {
         $purchases =Purchase::find($id);
         $b =$purchases->supplier_name;
         $supplier =Supplier::find($b);
         $details =DB::table('purchase_details')
                    ->where('invo_id',$id)
                    ->get();
    return view('admin.purchase.edit',compact('purchases','supplier','details'));
   }

   public function update(Request $request,$id)
   {

    $details =DB::table('purchase_details')->where('invo_id',$id)->delete();

    if ($details) {
      $product_name= $request->product_name;
      $product_id= $request->product_id;
      $price= $request->price;
      $qty= $request->qty;
       
      $data=array();
      $data['supplier_name']= $request->supplier_name;
      $data['supp_date']= $request->supp_date;
      $data['total']= $request->total;
      $data['status']= $request->status;
      DB::table('purchases')->where('id',$id)->update($data);


      for ($i=0; $i <count($product_id) ; $i++) { 
        $d =array();
        $d['invo_id'] =$id;
        $d['product_id'] =$product_id[$i];
        $d['product_name']=$product_name[$i];
        $d['qty']=$qty[$i];
        $d['price']=$price[$i];
        DB::table('purchase_details')->insert($d);

      }
    }
     $purchases =Purchase::find($id);
      $b =$purchases->supplier_name;
      $supplier =Supplier::find($b);
      $details =DB::table('purchase_details')
                    ->where('invo_id',$id)
                    ->get();
     return view('admin.purchase.editprint',compact('purchases','supplier','details'));
   }

      public function delete($id)
   {
    $purchase =Purchase::find($id);
    $a =$purchase->delete();
    if ($a) {
      $d=DB::table('purchase_details')->where('invo_id', '=', $id)->delete();
    }
    return Redirect::to('admin/purchase');
   }

   public function bysupplier()
   {
    return view('admin.purchase.bysupplier');
   }

   public function searching(Request $request)
   {
     $supplier_name= $request->supplier_name;
    $purchase= DB::table('purchases')
            ->join('purchase_details', 'purchases.id', '=', 'purchase_details.invo_id')
            ->select('purchases.*', 'purchase_details.*')
            ->where('purchases.supplier_name', '=' ,$supplier_name)
            ->get();
            $res ='';
foreach ($purchase as $key => $value) {
             $res.='<tr style="background:#222;color:#fff">';
             $res.='<td>'.$value->supp_date.'</td>';
             $res.='<td>'.$value->total.'</td>';
             $res.='<td>'.$value->status.'</td>';
             $res.='</tr>';
    
}
return $res;
   }

}
