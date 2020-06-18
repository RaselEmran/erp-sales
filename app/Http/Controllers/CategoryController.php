<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
  public function index()
  {
  	$category =Category::where('status',1)->get();
  	return view('admin.category.index',compact('category'));
  }
  public function create()
  {
    return view('admin.category.create');
  }

  public function store(Request $request)
  {
  	
  	   $this->validate($request, [
           'name' =>'required|unique:categories',
           'description'=>'required',
       ]);
        $category = new Category();
        $category->name =$request->name;

       $category->slug = str_slug($request->name);
       $category->description = $request->description;
       $category->save();
       return redirect('/admin/category')->with('msg','Category Added Succesfully');
  }

  public function edit(Request $request)
  {
     $id =$request->category_id;
     $category=Category::find($id);
     return response()->json($category);
  }

  public function update(Request $request)
  {
      $this->validate($request, [
           'name' =>'required',
           'description'=>'required',
       ]);

      $id =$request->id;
      $category=Category::find($id);
      $category->name =$request->name;
      $category->slug = str_slug($request->name);
      $category->description =$request->description;
      $category->save();
      return redirect('/admin/category')->with('msg','Category Updated Succesfully');

  }

  public function delete($id)
  {
    $category =Category::find($id);
    $category->status=false;
    $category->save();
    return redirect()->back();

  }
}
