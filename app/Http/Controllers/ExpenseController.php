<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Expense;
class ExpenseController extends Controller
{
    public function index()
    {
    	$expense =Expense::all();
    	return view('admin.expense.index',compact('expense'));
    }

    public function create()
    {
    	return view('admin.expense.create');
    }

    public function store(Request $request)
    {
    	$expense =new Expense();
    	$expense->purpose =$request->purpose;
    	$expense->expense_to =$request->expense_to;
    	$expense->date =$request->date;
    	$expense->vouchar_no =$request->vouchar_no;
    	$expense->amount =$request->amount;
    	$expense->paid =$request->paid;
    	$expense->note =$request->note;
    	$expense->save();
      return redirect('/admin/expense')->with('msg','Expense Added Succesfully');



    }

    public function edit(Request $request)
    {
    	$expense_id =$request->expense_id;

    	 $expense =Expense::find($expense_id);
     return response()->json($expense);
    }

    public function update(Request $request)
    {
    	$expense = Expense::find($request->id);
    	$expense->purpose =$request->purpose;
    	$expense->expense_to =$request->expense_to;
    	$expense->date =$request->date;
    	$expense->vouchar_no =$request->vouchar_no;
    	$expense->amount =$request->amount;
    	$expense->paid =$request->paid;
    	$expense->note =$request->note;
    	$expense->save();
      return redirect('/admin/expense')->with('msg','Expense Update Succesfully');
    }

    public function delete($id)
    {
    	$expense=Expense::find($id);
    	$expense->delete();
    	return redirect()->back();
    }
}
