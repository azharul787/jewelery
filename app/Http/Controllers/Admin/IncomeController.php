<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\Incometype;
use App\Model\Income;

class IncomeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:income-list');
         $this->middleware('permission:income-entry', ['only' => ['create','store']]);
         $this->middleware('permission:income-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:income-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Incometype::orderBy('type_name','ASC')->get();
        $expense = Income::latest()->get();
        return view('backend.admin.income.index',compact('type','expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'type_id'=>'required',
            'income_amount'=>'required',
            ]);
            
        $ex = new Income();
        $ex->incometype_id = $request->type_id;
        $ex->user_id = Auth::id();
        $dt = Carbon::parse($request->income_date);
        $ex->income_date = $dt->toDateTimeString();
        $ex->income_amount = $request->income_amount;
        $ex->description = $request->description;
        $ex->save();
        
        return redirect()->route('admin.income.index')->with('success','Income List Save Successfull');;
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
        $type = Incometype::orderBy('type_name','ASC')->get();
        $expense = Income::find($id);
        $expenses = Income::latest()->get();
        return view('backend.admin.income.edit',compact('type','expense','expenses'));
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
         $validate = request()->validate([
            'type_id'=>'required',
            'income_amount'=>'required',
            ]);
            
        $ex = Income::find($id);
        $ex->incometype_id = $request->type_id;
        $ex->user_id = Auth::id();
        $dt = Carbon::parse($request->income_date);
        $ex->income_date = $dt->toDateTimeString();
        $ex->income_amount = $request->income_amount;
        $ex->description = $request->description;
        $ex->save();
        
        return redirect()->route('admin.income.index')->with('success','Income List Update Successfull');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::find($id);
        $income->delete();

        return redirect()->route('admin.income.index')->with('success','Income List Delete Success');
    }
}
