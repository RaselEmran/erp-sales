<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_stock;

use DB;
class ProductController extends Controller
{
    public function index()
    {
     $product =Product::where('status',1)->get();
    	return view('admin.product.index',compact('product'));
    }
    public function create()
    {
      return view('admin.product.create');
    }

    public function store(Request $request)

    {
      $request->validate([
	    'name'=>'required',
      'stock'=>'required',
	    'category'=>'required',
	    'cost'=>'required',
	    'price'=>'required',
	    'description'=>'required',
	    'image' => 'mimes:jpeg,bmp,png|max:2000',

		]);
     $count=Product::count();
     $uid =substr(uniqid('', true), -4).substr(number_format(time() * rand(),0,'',''),0,2);
     if ($count>0) {
       $code ='PR0'.$uid.$count;
     }
     else
     {
      $code ="PR00".$uid;
     }
      $product =new Product();
        $image=$request->file('image');
    	 if ($image) {

             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/product/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);

         
      $product->code =$code;
      $product->name =$request->name;
      $product->category =$request->category;
      $product->cost =$request->cost;
      $product->price =$request->price;
      $product->description =$request->description;
      $product->image =$image_url;
      $product->stock =$request->stock;
      $product->save();
      $id =$product->id;
      //..................
      $date =date('m/d/Y');
      $stockinfo=new Product_stock();
      $stockinfo->product_id=$id;
      $stockinfo->product_code=$code;
      $stockinfo->item_stock =$request->stock;
      $stockinfo->date =$date;
      $stockinfo->save();
    }
    else
{
      $product->code =$code;
      $product->name =$request->name;
      $product->category =$request->category;
      $product->cost =$request->cost;
      $product->price =$request->price;
      $product->description =$request->description;
      $product->stock =$request->stock;
      $product->save();
      $id =$product->id;
      //..................
      $date =date('m/d/Y');
      $stockinfo=new Product_stock();
      $stockinfo->product_id=$id;
      $stockinfo->product_code=$code;
      $stockinfo->item_stock =$request->stock;
      $stockinfo->date =$date;
      $stockinfo->save(); 
}

      return redirect('/admin/product')->with('msg','Product Added Succesfully');

     

    }

      public function edit(Request $request)
  {
     $id =$request->product_id;
     $product = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.name as cat_name')
            ->where('products.id', '=' ,$id)
            ->first();
     return response()->json($product);
  }
  public function dropdown(Request $request)
  {
  	$cat =DB::table('categories')->get();
  	$id =$request->product_id;
  	  $product = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.name as cat_name')
            ->where('products.id', '=' ,$id)
            ->first();
            $res ='';
            $res.='<label>Category</label>';
            $res.='<select class="form-control select2" name="category"><option value="'.$product->category.'">'.$product->cat_name.'</option>';
            foreach ($cat as $key => $value) {
            	$res.='<option value="'.$value->id.'">'.$value->name.'</option>';
            }
            $res.='</select>';
            return $res;
  }

  public function update(Request $request)

  {

   $request->validate([
      'name'=>'required',
      'category'=>'required',
      'cost'=>'required',
      'price'=>'required',
      'description'=>'required',
      'image' => 'mimes:jpeg,bmp,png|max:2000',

    ]);
      
      $id =$request->id;
      $product =Product::find($id);
      $image=$request->file('image');
       if ($image) {
        if ($product->image) {
            unlink(public_path($product->image));
        }
      
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/product/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);

         }
         else{
          $image_url = $product->image;
         }
      $product->name =$request->name;
      $product->category =$request->category;
      $product->cost =$request->cost;
      $product->price =$request->price;
      $product->description =$request->description;
      $product->image =$image_url;
      $product->save();
      return redirect('/admin/product')->with('msg','Product Upateds Succesfully');

  }
  public function delete($id)
  {
    $product =Product::find($id);

    $product->status=false;
    $product->save();
     return redirect()->back();

  }

  public function stock(Request $request)
  {
    $id =$request->product_id;
    $product =Product::find($id);
    return response()->json($product);
  }

  public function newstock(Request $request)
  {
    $up =$request->up_quantity;
    if ($up !=null && $up!=0) {
    $product =Product::find($request->id);
    $product->stock =$request->total_qty;
    $product->save();
    //......
    $stockinfo =new Product_stock();
    $stockinfo->product_id =$request->id;
    $stockinfo->product_code =$request->product_code;
    $stockinfo->item_stock =$request->up_quantity;
    $stockinfo->date =date('m/d/Y');

     return redirect('/admin/product')->with('msg','Product Stock Update Succesfully');

    }
    else
    {
      return redirect('/admin/product')->with('msg','something Wrong'); 
    }
  }

  public function barcode($id)
  {
    $p_code =Product::find($id);
    return view('admin.product.barcode',compact('p_code'));
  }
}
