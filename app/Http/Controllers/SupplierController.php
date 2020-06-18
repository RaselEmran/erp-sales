<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
class SupplierController extends Controller
{
  public function index()

  {
  	$supplier = Supplier::where('status',1)->get();
  	return view('admin.supplier.index',compact('supplier'));
  }
   public function create()
    {
      return view('admin.supplier.create');
    }

  public function store(Request $request)
  {
  	    $request->validate([
	    'name'=>'required',
	    'phone'=>'required',
	    'image' => 'mimes:jpeg,bmp,png|max:2000',

		]);

		$supplier = new Supplier();
		  $image=$request->file('image');
    	 if ($image) {

             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/supplier/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);

         
         $supplier->name =$request->name;
         $supplier->email =$request->email;
         $supplier->phone =$request->phone;
         $supplier->address =$request->address;
         $supplier->image =$image_url;
         $supplier->save();
       }
       else
          {
         $supplier->name =$request->name;
         $supplier->email =$request->email;
         $supplier->phone =$request->phone;
         $supplier->address =$request->address;
         $supplier->save();
          }

         return redirect('/admin/supplier')->with('msg','Supplier Added Succesfully');

  }

  public function edit(Request $request)
  {
  	$supplier =Supplier::find($request->supplier_id);
  	 return response()->json($supplier);
  }

  public function update(Request $request)
  {
  	   $request->validate([
	    'name'=>'required',
	    'phone'=>'required',
	    'image' => 'mimes:jpeg,bmp,png|max:2000',

		]);
  	$id =$request->id;
  	$supplier =Supplier::find($id);

  		 $image=$request->file('image');
    	 if ($image) {
             if ($supplier->image) {
            unlink(public_path($supplier->image));
             }
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/supplier/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);

         }
         else
         {
         	$image_url=$supplier->image;
         }
         $supplier->name =$request->name;
         $supplier->email =$request->email;
         $supplier->phone =$request->phone;
         $supplier->address =$request->address;
         $supplier->image =$image_url;
         $supplier->save();
         return redirect('/admin/supplier')->with('msg','Supplier update Succesfully');

  }

    public function delete($id)
  {
    $supplier =Supplier::find($id);
    $supplier->status=false;
    $supplier->save();
     return redirect()->back();

  }

}
