<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Expensetype;

class ExpenseTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:expense-type-list');
         $this->middleware('permission:expense-type-entry', ['only' => ['create','store']]);
         $this->middleware('permission:expense-type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:expense-type-delete', ['only' => ['destroy']]);
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
            $categories = Expensetype::latest()->paginate($show);
        }else{
            $categories = Expensetype::latest()->paginate(10);
        }
        
        return view('backend.admin.expense_type.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.expense_type.create');
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
            'type_name'=>'required|unique:expensetypes',
            'description'=>'required',
            ]);
            
        $type = new Expensetype();
        $type->type_name = $request->type_name;
        $type->description = $request->description;
        $type->save();
            
        return redirect()->route('admin.expense_type.index')->with('success','Type List Save Successfull');
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
        $type = Expensetype::find($id);
        $types = Expensetype::latest()->paginate(10);
        return view('backend.admin.expense_type.edit',compact('type','types'));
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
        //return $request->all();
       $this->validate($request,[
        'type_name'=>'required',
        'description'=>'required',
        ]);
        
        $type = Expensetype::find($id);
        $type->type_name = $request->type_name;
        $type->description = $request->description;
        $type->save();
            
        return redirect()->route('admin.expense_type.index')->with('success','Type Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Expensetype::find($id);
        $type->delete();
        
        return redirect()->back()->with('success','Type List Delete Successfull');
    }
}
