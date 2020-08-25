<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Incometype;

class IncometypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:income-type-list');
         $this->middleware('permission:income-type-entry', ['only' => ['create','store']]);
         $this->middleware('permission:income-type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:income-type-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Incometype::latest()->get();
        return view('backend.admin.income_type.index',compact('type'));
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
            'type_name'=>'required|unique:incometypes',
            'description'=>'required'
        ]);
            
        $type = new Incometype();
        $type->type_name = $request->type_name;
        $type->description = $request->description;
        $type->save();
            
        Toastr::success('Type List Save Successfull','Successfull');
        return redirect()->route('admin.incometype.index');
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
        $type = Incometype::find($id);
        $types = Incometype::latest()->get();
        return view('backend.admin.income_type.edit',compact('type','types'));
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
        $dalidate = request()->validate([
            'type_name'=>'required|unique:incometypes',
            'description'=>'required'
        ]);
        
        $type = Incometype::find($id);
        $type->type_name = $request->type_name;
        $type->description = $request->description;
        $type->save();
            
        Toastr::success('Type Update Successfull','Successfull');
        return redirect()->route('admin.incometype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Incometype::find($id);
        $type->delete();
        
        Toastr::success('Type List Delete Successfull','Successfull');
        return redirect()->back();
    }
}
