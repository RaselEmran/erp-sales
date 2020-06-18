<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Account;
use App\Payment;
class AccountController extends Controller
{
    public function index()
    {
    	$account = Account::all();
    	return view('admin.account.index',compact('account'));
    }

    public function acc_store(Request $request)
    {
      $this->validate($request, [
           'acc_name' =>'required',
           'root_acc'=>'required',

       ]);

      $account =new Account();
      $account->acc_name =$request->acc_name;
      $account->root_acc =$request->root_acc;
      $account->save();
      return redirect('admin/account')->with('msg','Account Added Succesfully');

    }

    public function acc_edit(Request $request)
    {
    	$id =$request->acc_id;
    	$account =Account::find($id);
    	return response()->json($account);

    }

    public function dropdown(Request $request)
    {
    	$id =$request->acc_id;
    	$account =Account::find($id);
    	 $res ='';
            $res.='<label>Category</label>';
            $res.='<select class="form-control select2" name="root_acc">
            <option value="'.$account->root_acc.'">'.$account->root_acc.'</option>';
            $res.='<option value="customer">Customer</option>';
            $res.='<option value="supplier">Supplier</option>';
            $res.='<option value="office">Office</option>';
            $res.='<option value="loan">Loan</option>';
            $res.='</select>';
            return $res;
    }

    public function acupdate(Request $request)
    {

     $this->validate($request, [
           'acc_name' =>'required',
           'root_acc'=>'required',

       ]);

      $id =$request->hidden;
      $account =Account::find($id);
      $account->acc_name =$request->acc_name;
      $account->root_acc =$request->root_acc;
      $account->save();
      return redirect('admin/account')->with('msg','Account Update Succesfully');
    }

    public function ac_deete($id)
    {
    	$account =Account::find($id);
    	$account->delete();
    	return redirect('admin/account');


    }

    public function payment()
    {
    	$payment =Payment::where('payment_type','payment')->get();
    	return view('admin.account.payment',compact('payment'));
    }

    public function paymentfrom(Request $request)
    {
    	  $this->validate($request, [
           'ac_date' =>'required',
           'description'=>'required',
           'root_acc'=>'required',
           'amount'=>'required',



       ]);
      $payment =new Payment();
      $payment->ac_date =$request->ac_date;
      $payment->description =$request->description;
      $payment->root_acc =$request->root_acc;
      $payment->customer =$request->customer;
      $payment->supplier =$request->supplier;
      $payment->office =$request->office;
      $payment->loan_name =$request->loan_name;
      $payment->mode =$request->mode;
      $payment->amount =$request->amount;
      $payment->check_num =$request->check_num;
      $payment->check_date =$request->check_date;
      $payment->bank_name =$request->bank_name;
      $payment->payment_type ='payment';
      $payment->save();

      return redirect('admin/account/payment')->with('msg','Payment Accept Succesfully');



    }

    public function pay_edit($id)
    {
    	$payment =Payment::find($id);

    	return view('admin.account.pay_edit',compact('payment'));
    }

    public function up_payment(Request $request,$id)
    {


    $this->validate($request, [
           'ac_date' =>'required',
           'description'=>'required',
           'root_acc'=>'required',
           'amount'=>'required',



       ]);
      $payment =Payment::find($id);
      $payment->ac_date =$request->ac_date;
      $payment->description =$request->description;
      $payment->root_acc =$request->root_acc;
      $payment->customer =$request->customer;
      $payment->supplier =$request->supplier;
      $payment->office =$request->office;
      $payment->loan_name =$request->loan_name;
      $payment->mode =$request->mode;
      $payment->amount =$request->amount;
      $payment->check_num =$request->check_num;
      $payment->check_date =$request->check_date;
      $payment->bank_name =$request->bank_name;
      $payment->payment_type ='payment';
      $payment->save();

      return redirect('admin/account/payment')->with('msg','Payment Information Update Succesfully');
    }

    public function pay_delete($id)
    {
     $payment =Payment::find($id);
     $payment->delete();
     return redirect('/admin/account/payment');

    }

    public function receipt()
    {
    	$payment =Payment::where('payment_type','receipt')->get();
    	return view('admin.account.receipt',compact('payment'));
    }

    //receipt............

    public function receipt_from(Request $request)
    {
     $this->validate($request, [
           'ac_date' =>'required',
           'description'=>'required',
           'root_acc'=>'required',
           'amount'=>'required',



       ]);
      $payment =new Payment();
      $payment->ac_date =$request->ac_date;
      $payment->description =$request->description;
      $payment->root_acc =$request->root_acc;
      $payment->customer =$request->customer;
      $payment->supplier =$request->supplier;
      $payment->office =$request->office;
      $payment->loan_name =$request->loan_name;
      $payment->mode =$request->mode;
      $payment->amount =$request->amount;
      $payment->check_num =$request->check_num;
      $payment->check_date =$request->check_date;
      $payment->bank_name =$request->bank_name;
      $payment->payment_type ='receipt';
      $payment->save();

      return redirect('admin/account/receipt')->with('msg','Receipt Accept Succesfully');
    }

    public function rec_edit($id)
    {
    	$payment =Payment::find($id);

    	return view('admin.account.rec_edit',compact('payment'));
    }

    public function upreceipt(Request $request,$id)
    {
      $this->validate($request, [
           'ac_date' =>'required',
           'description'=>'required',
           'root_acc'=>'required',
           'amount'=>'required',



       ]);
      $payment = Payment::find($id);
      $payment->ac_date =$request->ac_date;
      $payment->description =$request->description;
      $payment->root_acc =$request->root_acc;
      $payment->customer =$request->customer;
      $payment->supplier =$request->supplier;
      $payment->office =$request->office;
      $payment->loan_name =$request->loan_name;
      $payment->mode =$request->mode;
      $payment->amount =$request->amount;
      $payment->check_num =$request->check_num;
      $payment->check_date =$request->check_date;
      $payment->bank_name =$request->bank_name;
      $payment->payment_type ='receipt';
      $payment->save();

      return redirect('admin/account/receipt')->with('msg','Receipt Information Update Succesfully');
    }
    
}
