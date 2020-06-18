<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
class ClientController extends Controller
{
     public function index()
    {
     $client =Client::where('status',1)->get();
    	return view('admin.client.index',compact('client'));
    }
 
  public function create()
  {
  	return view('admin.client.create');
  }

  public function store(Request $request)
  {
  	    $request->validate([
	    'name'=>'required',
	    'phone'=>'required',
	    'image' => 'mimes:jpeg,bmp,png|max:2000',

		]);

		  $client = new Client();
		  $image=$request->file('image');
    	 if ($image) {

             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/client/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);

         
         $client->name =$request->name;
         $client->email =$request->email;
         $client->address =$request->address;
         $client->phone =$request->phone;
         $client->image =$image_url;
         $client->save();
       }

       else{
         $client->name =$request->name;
         $client->email =$request->email;
         $client->address =$request->address;
         $client->phone =$request->phone;
         $client->save();
       }
         return redirect('/admin/client')->with('msg','Client Added Succesfully');
       }

  

        public function edit(Request $request)
  {
     $id =$request->client_id;
     $client = Client::find($id);
     return response()->json($client);
  }

  public function update(Request $request)
  {
  	 	   $request->validate([
	    'name'=>'required',
	    'phone'=>'required',
	    'image' => 'mimes:jpeg,bmp,png|max:2000',

		]);
         
		 $id =$request->id;
		 $client = Client::find($id);
		  $image=$request->file('image');
    	 if ($image) {
            if ($client->image) {
            unlink(public_path($client->image));
             }
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/client/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);

         }
         else
         {
         	$image_url=$client->image;
         }
         $client->name =$request->name;
         $client->email =$request->email;
         $client->address =$request->address;
         $client->phone =$request->phone;
         $client->image =$image_url;
         $client->save();
         return redirect('/admin/client')->with('msg','Client Update Succesfully');
  }

      public function delete($id)
  {
    $client =Client::find($id);
    $client->status=false;
    $client->save();
     return redirect()->back();

  }

}
