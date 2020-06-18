<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Supplier;
use App\Client;


class BackupController extends Controller
{
    public function backup()
    {
    return view('admin.backup.index');
    }

    public function product()
    {
    	$product =Product::where('status',0)->get();
    	return view('admin.backup.product',compact('product'));
    }

    public function resetproduct(Request $request)
    {
    	  $id=$request->selector;
           if ($id) {
         	 for ($i=0; $i <count($id) ; $i++) { 
    	 	 $product =Product::find($id[$i]);
    	 	$product->status=true;
    	 	$product->save();
  

    	      }
    	  return redirect()->back()->with('msg','Data Backup Successfully');
          }
          else
          {
          	 return redirect()->back()->with('emsg','You Are Not Selected Data');
          }
    	
    }

    public function destroyproduct(Request $request)
    {
    	$id=$request->selector;
        if ($id) {
         for ($i=0; $i <count($id) ; $i++) { 
    	 	 $product =Product::find($id[$i]);
    	   if ($product->image) {
            unlink(public_path($product->image));
        }
    	 	$product->delete();
    	 }
    	 return redirect()->back()->with('msg','Data Destroy Successfully');
        }
          else
          {
          	 return redirect()->back()->with('emsg','You Are Not Selected Data');
          }
    }

    public function category()
    { 
    	$category =Category::where('status',0)->get();
    	return view('admin.backup.category',compact('category'));
    }

    public function resetcategory(Request $request)
    {
    	 $id=$request->selector;
           if ($id) {
         	 for ($i=0; $i <count($id) ; $i++) { 
    	 	 $category =Category::find($id[$i]);
    	 	 $category->status=true;
    	 	 $category->save();
  

    	      }
    	  return redirect()->back()->with('msg','Data Backup Successfully');
          }
          else
          {
          	 return redirect()->back()->with('emsg','You Are Not Selected Data');
          }
    }

        public function destroycategory(Request $request)
    {
    	$id=$request->selector;
        if ($id) {
         for ($i=0; $i <count($id) ; $i++) { 
    	 	 $category =Category::find($id[$i]);

    	 	$category->delete();
    	 }
    	 return redirect()->back()->with('msg','Data Destroy Successfully');
        }
          else
          {
          	 return redirect()->back()->with('emsg','You Are Not Selected Data');
          }
    }
    public function supplier()
    {
    	$supplier =Supplier::where('status',0)->get();

 	   return view('admin.backup.supplier',compact('supplier'));
    }
   public function resetsupplier(Request $request)
   {
   	 $id=$request->selector;
           if ($id) {
         	 for ($i=0; $i <count($id) ; $i++) { 
    	 	 $supplier =Supplier::find($id[$i]);
    	 	 $supplier->status=true;
    	 	 $supplier->save();
  

    	      }
    	  return redirect()->back()->with('msg','Data Backup Successfully');
          }
          else
          {
          	 return redirect()->back()->with('emsg','You Are Not Selected Data');
          }
   } 

       public function destroysupplier(Request $request)
    {
    	$id=$request->selector;
        if ($id) {
         for ($i=0; $i <count($id) ; $i++) { 
    	 	 $supplier =Supplier::find($id[$i]);
    	 	 if ($supplier) {
    	 	 	unlink($supplier->image);
    	 	 }
    	 	$supplier->delete();
    	 }
    	 return redirect()->back()->with('msg','Data Destroy Successfully');
        }
          else
          {
          	 return redirect()->back()->with('emsg','You Are Not Selected Data');
          }
    }

    public function client()
    {
    	$client =Client::where('status');
    	return view('admin.backup.client',compact('client'));
    }
}
