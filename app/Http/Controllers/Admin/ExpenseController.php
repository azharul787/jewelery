<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\Branch;
use App\Model\Expense;
use App\Model\Expensetype;
use App\Model\Ledger;
use DB;

class ExpenseController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:expense-list');
         $this->middleware('permission:expense-entry', ['only' => ['create','store']]);
         $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:expense-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show = $request->show;
        if($show != ''){
            $expenses = Expense::latest()->paginate($show);
        }
        else{
            $expenses = Expense::latest()->paginate(10);
        }
        
        return view('backend.admin.expense.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Expensetype::orderBy('type_name','ASC')->get();
        return view('backend.admin.expense.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type_name'=>'required',
            'expense_amount'=>'required',
            ]);
            
        $ex = new Expense();
        $ex->expensetype_id = $request->type_name;
        $ex->user_id = Auth::id();
        $dt = Carbon::parse($request->expense_date);
        $ex->expense_date = $dt->toDateTimeString();
        $ex->expense_amount = $request->expense_amount;
        $ex->description = $request->description;
        $ex->save();

        return redirect()->route('admin.expense.index')->with('success','Expense Amount Save Successfull');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $types = Expensetype::orderBy('type_name','ASC')->get();
        $expense = Expense::find($id);
        $expenses = Expense::latest()->paginate(10);
        //return $expense;
        return view('backend.admin.expense.edit',compact('types','expense','expenses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'type_name'=>'required',
            'expense_amount'=>'required',
            ]);
            
        $ex = Expense::find($id);
        $ex->expensetype_id = $request->type_name;
        $ex->user_id = Auth::id();
        $dt = Carbon::parse($request->expense_date);
        $ex->expense_date = $dt->toDateTimeString();
        $ex->expense_amount = $request->expense_amount;
        $ex->description = $request->description;
        $ex->save();
            
        return redirect()->route('admin.expense.index')->with('success','Expense List Update Successfull');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
    
        return redirect()->back()->with('success','Expense List Delete Successfull');
    }
}
