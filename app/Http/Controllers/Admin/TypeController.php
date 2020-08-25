<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Type;

class TypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:type-list');
         $this->middleware('permission:type-entry', ['only' => ['create','store']]);
         $this->middleware('permission:type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:type-delete', ['only' => ['destroy']]);
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
            $types = Type::latest()->paginate($show);
        }else{
            $types = Type::latest()->paginate(10);
        }
		
        return view('backend.admin.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'type_name'=>'required|unique:types'
            ]);
            
            $type = new Type();
            $type->type_name = $request->type_name;
            $type->save();
            

            return redirect()->route('admin.type.index')->with('success','Type List Save Successfull');
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
        $type = Type::find($id);
        $types = Type::latest()->paginate(10);

        return view('backend.admin.type.edit',compact('types','type'));
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
            'type_name'=>'required'
        ]);
        $type = Type::find($id);
        $type->type_name = $request->type_name;
        $type->save();

        return redirect()->route('admin.type.index')->with('success','Type List Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();

        return redirect()->back()->with('success','Type List Delete Successfull');
    }
}
