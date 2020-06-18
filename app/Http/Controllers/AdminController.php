<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class AdminController extends Controller
{
    public function index()
    {
    $admin_id =Session::get('admin_id');
        if ($admin_id) {
            return view('admin.main');
        }
        else{
        return view('login');
    }
    }

    public function showdashbord()

    {
     return view('admin.main');

    }

    public function login(Request $request)
    {
    	$email=$request->email;
    	$password=md5($request->password);
    	$result=DB::table('admins')
    	    ->where('email',$email)
    	    ->where('password',$password)
    	    ->first();
    	    if ($result) {
    	        Session::put('admin_name',$result->name);
                Session::put('admin_id',$result->id);
                return redirect('/admin/dashboard');
    	    }
    	    else
    	    {
    	        Session::put('msg','Email and Password doesnt Match');
                return redirect('/admin');
    	    }

    }

    //........profile
    public function profile($id)

    {
      $profile =DB::table('admins')->where('id',$id)->first();
      return view('admin.setting.profile',compact('profile'));
    }

    public function up_profile(Request $request,$id)

    {
       $user = DB::table('admins')->where('id', $id)->first();
         if (!empty($user->image) ) {
         $image=$request->file('image');
         if ($image) {
             unlink($user->image);
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/profile/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);


         }

         else
         {
         $image_url=$user->image;
               
         }
             $d =array();
             $d['email'] =$request->email;
             $d['name'] =$request->name;
             $d['image'] =$image_url;
             DB::table('admins')->where('id', $id)->update($d);
             return redirect()->back()->with('msg','User Update Succesfully');
         }
         else
         {
            $image=$request->file('image');
            if ($image) {
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/profile/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);
             $d =array();
             $d['email'] =$request->email;
             $d['name'] =$request->name;
             $d['image'] =$image_url;
             DB::table('admins')->where('id', $id)->update($d);
             return redirect()->back()->with('msg','User Update Succesfully');


         }
         else{
             $data =array();
             $data['email'] =$request->email;
             $data['name'] =$request->name;
             DB::table('admins')->where('id', $id)->update($data);
             return redirect()->back()->with('msg','User Update Succesfully');
         }

         }

    }

    public function password(Request $request)
    {
       $old =$request->old;
       $oldpass =md5($old);
       $email =$request->email;
       $pass =DB::table('admins')->where('email',$email)->where('password',$oldpass)->first();
       if ($pass) {
     
       return '<span style="color:green">'.$old.' Password is Correct</spam>';
       }
       else
       {
         return '<span style="color:red">'.$old.' Password is incorrect</spam>';
       }
    }

    public function upppass(Request $request)
    {

        $email=$request->email;
        $old=$request->old;
        $oldpass =md5($old);
        $new=MD5($request->new);
        $pass =DB::table('admins')->where('email',$email)->where('password',$oldpass)->update(['password'=>$new]);
       if ($pass) {
            return redirect()->back()->with('msg','Password Update Succesfully');
       }
       else
       {
        return redirect()->back()->with('msg','Something Error');
       }


    }

    
}
