<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Loan;
use App\Loanee;
use App\Lender;
class LoanController extends Controller
{
    public function index()
    {
    	return view('admin.loan.index');
    }

    public function singledetails($id)
    {
    $single =DB::table('loans')->where('loanee',$id)->get();
   	return view('admin.loan.details',compact('id','single'));
    }

    public function store(Request $request)
    {
      $loan =new Loan();
      $loan->loanee =$request->loanee;
      $loan->lendar =$request->lendar;
      $loan->date =$request->date;	
      $loan->amount =$request->amount;	
      $loan->paid =$request->paid;	
      $loan->note =$request->note;
      $loan->save();
      return redirect('/admin/loan')->with('msg','Loan Added Succesfully');	


    }

    public function edit($id)
    {
    	$loan =Loan::find($id);
    	return view('admin.loan.loanedit',compact('loan'));
    }

    public function update(Request $request,$id)
    {
      $loan =Loan::find($id);	
      $loan->loanee =$request->loanee;
      $loan->lendar =$request->lendar;
      $loan->date =$request->date;	
      $loan->amount =$request->amount;	
      $loan->paid =$request->paid;	
      $loan->note =$request->note;
      $loan->save();
      return redirect('/admin/loan')->with('msg','Loan Update Succesfully');	

    }

    public function loanee()
    {
    	$lonee =Loanee::all();
    	return view('admin.loan.lonee',compact('lonee'));
    }

    public function loaneestore(Request $request)
    {
    	$loanee =new Loanee();
    	$loanee->name =$request->name;
    	$loanee->note =$request->note;
    	$loanee->save();
      return redirect('/admin/loan/loanee')->with('msg','Loanee Added Succesfully');	


    }

    public function loaneeedit(Request $request)

    {
     $id =$request->loanee_id;
     $loanee=Loanee::find($id);
     return response()->json($loanee);
    }

    public function loaneeupdate(Request $request)
    {
    	$loanee =Loanee::find($request->id);
    	$loanee->name =$request->name;
    	$loanee->note =$request->note;
    	$loanee->save();
      return redirect('/admin/loan/loanee')->with('msg','Loanee Update Succesfully');	



    }

    public function loaneedelete($id)
    {
    	$loanee =Loanee::find($id);
    	$loanee->delete();
    	return redirect('/admin/loan/loanee');
    }
 

   public function lender()
   {
   	$lendar =Lender::all();
   	return view('admin.loan.lendar',compact('lendar'));
   }

   public function lendarstore(Request $request)
   {
   	$lender =new Lender();
   	$lender->name =$request->name;
    $lender->note =$request->note;
    $lender->save();
    return redirect('/admin/loan/lendar')->with('msg','Lendar Added Succesfully');	

   }

   public function lendaredit(Request $request)
   {
   	 $id =$request->lendar_id;
     $lendar=Lender::find($id);
     return response()->json($lendar);
   }

   public function lendarupdate(Request $request)
   {
   	$lender =Lender::find($request->id);
    $lender->name =$request->name;
    $lender->note =$request->note;
    $lender->save();
      return redirect('/admin/loan/lendar')->with('msg','Lendar Update Succesfully');
   }

     public function lendardelete($id)
    {
    	$loanee =Lender::find($id);
    	$loanee->delete();
    	return redirect('/admin/loan/lendar');
    }

}
