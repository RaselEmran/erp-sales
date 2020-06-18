<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bank;
use App\AcCreditTransfer;
use App\AcDebitTransfer;


class BankController extends Controller
{
    public function index()
    {

    	$bank = Bank::all();
    	return view('admin.bank.index',compact('bank'));
    }

    public function store(Request $request)
    {
    	$bank=new Bank();
    	$bank->b_name =$request->b_name;
    	$bank->ac_name =$request->ac_name;
    	$bank->ac_number =$request->ac_number;
    	$bank->bc_name =$request->bc_name;
    	$bank->save();
    	return redirect('/admin/bank')->with('msg','Bank Added Succesfully');

    }

    public function edit(Request $request)
    {

     $id =$request->bank_id;
     $bank=Bank::find($id);
     return response()->json($bank);
    }

    public function update(Request $request)
    {
    	$bank=Bank::find($request->id);
        $bank->b_name =$request->b_name;
    	$bank->ac_name =$request->ac_name;
    	$bank->ac_number =$request->ac_number;
    	$bank->bc_name =$request->bc_name;
    	$bank->save();
    	return redirect('/admin/bank')->with('msg','Bank Update Succesfully');
    }

    public function delete($id)
    {
    $bank =Bank::find($id);
    $bank->delete();
    return redirect()->back();
    }

    public function transfer()
    {
        $transfer=AcCreditTransfer::all();
        $from =AcDebitTransfer::all();
        return view('admin.bank.transfer',compact('transfer','from'));
    }
    public function createtransfer()
    {
        $bank = Bank::all();
        return view('admin.bank.createtransfer',compact('bank'));
    }

    public function transfer_from(Request $request)
    {
           $this->validate($request, [
           'frombank' =>'required',
           'tobank'=>'required',
           'ac_date'=>'required',
           'description'=>'required',
           'ac_amount'=>'required',

       ]);
           
           $data =array();
           $data['ac_name'] =$request->tobank;
           $data['ac_number'] ='NULL';
           $data['transfer_form']=$request->frombank;
           $data['ac_description'] =$request->description;
           $data['ac_amount'] =$request->ac_amount;
           $data['ac_date'] =$request->ac_date;
           $fist =DB::table('ac_credit_transfers')->insert($data);
             $transfer_id = DB::getPdo()->lastInsertId();
           if ($fist) {
           $d =array();
           $d['ac_name'] =$request->frombank;
           $d['ac_number'] ='NULL';
           $d['transfer_id']=$transfer_id;
           $d['transfer_to']=$request->tobank;
           $d['ac_description'] =$request->description;
           $d['ac_amount'] =$request->ac_amount;
           $d['ac_date'] =$request->ac_date;
           DB::table('ac_debit_transfers')->insert($d);
        return redirect('/admin/bank/transfer')->with('msg','Account Transfer Succesfully');

           }


    }

    public function edittranfer($id)
    { 
        $bank = Bank::all();
        $trans =AcCreditTransfer::find($id);
        return view('admin.bank.edittranfer',compact('trans','bank'));
    }

    public function uptransfer_from(Request $request,$id)
    {
           $this->validate($request, [
           'frombank' =>'required',
           'tobank'=>'required',
           'ac_date'=>'required',
           'description'=>'required',
           'ac_amount'=>'required',

       ]);
           
           $data =array();
           $data['ac_name'] =$request->tobank;
           $data['ac_number'] ='NULL';
           $data['transfer_form']=$request->frombank;
           $data['ac_description'] =$request->description;
           $data['ac_amount'] =$request->ac_amount;
           $data['ac_date'] =$request->ac_date;
           $fist =DB::table('ac_credit_transfers')->where('id',$id)->update($data);
           if ($fist) {
           $d =array();
           $d['ac_name'] =$request->frombank;
           $d['ac_number'] ='NULL';
           $d['transfer_to']=$request->tobank;
           $d['ac_description'] =$request->description;
           $d['ac_amount'] =$request->ac_amount;
           $d['ac_date'] =$request->ac_date;
           DB::table('ac_debit_transfers')->where('transfer_id',$id)->update($d);
        return redirect('/admin/bank/transfer')->with('msg','Account Transfer Update Succesfully');

           }

    }

    public function transfer_delete($id)
    {
        $ac_credit=DB::table('ac_credit_transfers')->where('id',$id)->delete();
        if ($ac_credit) {
            DB::table('ac_debit_transfers')->where('transfer_id',$id)->delete();
            return redirect('/admin/bank/transfer');
        }
    }

    public function transjaction()
    {
        $transfer=AcCreditTransfer::all();
        $from =AcDebitTransfer::all();
        return view('admin.bank.transjaction',compact('transfer','from'));
    }
}
