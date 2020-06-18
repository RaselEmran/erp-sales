<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use App\System;
use App\Company;

use DB;

class SettingController extends Controller
{
    public function sendmail(Request $request)
    {
    $this->validate($request, [
      'name'     =>  'required',
      'emailto'  =>  'required|email',
      'subject' =>  'required',
      'message' =>  'required',

     ]);

         $data = array(
            'name'      =>  $request->name,
            'subject'   =>  $request->subject,
            'message'   =>   $request->message
        );

     Mail::to($request->emailto)->send(new SendMailable($data));
     return back()->with('msg', 'Thanks for contacting us!');

    }

    public function setting()
    {
      $system =System::find('1');
      return view('admin.setting.sofsett',compact('system'));
    }

    public function sett(Request $request)
    {
     
     $system =System::count();
     if ($system==0) {
   
         $image=$request->file('image');
         if ($image) {
      
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/setting/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);
            
         }

            $data =array();
             $data['system_name'] =$request->system_name;
             $data['title'] =$request->title;
             $data['fotter_text'] =$request->fotter_text;
             $data['login_title'] =$request->login_title;

             $data['image'] =$image_url;
             DB::table('systems')->insert($data);
             return redirect()->back()->with('msg',' Succesfully Added');

     }
     else
     {
        $image=$request->file('image');
        $user = DB::table('systems')->where('id', '1')->first();
        

         if ($image) {

             unlink($user->image);
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/setting/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);
            
         }
         else
         {
           $image_url = $user->image;
         }

            $data =array();
             $data['system_name'] =$request->system_name;
             $data['title'] =$request->title;
             $data['fotter_text'] =$request->fotter_text;
             $data['login_title'] =$request->login_title;

             $data['image'] =$image_url;
             DB::table('systems')->where('id', '1')->update($data);
             return redirect()->back()->with('msg',' Update Succesfully Added');
     }
    }

    public function companyprofile()
    {
        $company =Company::first();

        return view('admin.setting.comprofile',compact('company'));
    }

    public function company(Request $request)
    {

        $count =Company::count();
        if ($count ==0) {
        $image=$request->file('image');
         if ($image) {
      
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/company/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);
            
         }
      $company =new Company();
      $company->name=$request->name;
      $company->Addess=$request->Addess;
      $company->mobile=$request->mobile;
      $company->email=$request->email;
      $company->website=$request->website;
      $company->image=$image_url;
      $company->save();
      return redirect()->back()->with('msg','Profile add');
        }
        else
        {
           $company =Company::orderBy('id', 'DESC')->first();
               $image=$request->file('image');
         if ($image) {
             unlink($company->image);
             $image_name = str_random(20);
             $ext = strtolower($image->getClientOriginalExtension());
             $image_full_name = $image_name.'.'.$ext;
             $upload_path = 'backend/company/';
             $image_url = $upload_path.$image_full_name;
             $success = $image->move($upload_path,$image_full_name);
            
         }
         else
         {
            $image_url=$company->image;
         }
      $company->name=$request->name;
      $company->Addess=$request->Addess;
      $company->mobile=$request->mobile;
      $company->email=$request->email;
      $company->website=$request->website;
      $company->image=$image_url;
      $company->save();
      return redirect()->back()->with('msg','Profile Update');


        }
     


    }
}
