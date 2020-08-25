<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Caret;

class CaretController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:caret-list');
         $this->middleware('permission:caret-entry', ['only' => ['create','store']]);
         $this->middleware('permission:caret-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:caret-delete', ['only' => ['destroy']]);
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
            $carets = Caret::latest()->paginate($show);
        }else{
            $carets = Caret::latest()->paginate(10);
        }
		
        return view('backend.admin.caret.index',compact('carets'));
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
            'caret_name'=>'required|unique:carets'
            ]);
            
            $caret = new Caret();
            $caret->caret_name = $request->caret_name;
            $caret->save();
            

            return redirect()->route('admin.caret.index')->with('success','Caret List Save Successfull');
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
        $caret = Caret::find($id);
        $carets = Caret::latest()->paginate(10);

        return view('backend.admin.caret.edit',compact('carets','caret'));
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
            'caret_name'=>'required'
        ]);
        $caret = Caret::find($id);
        $caret->caret_name = $request->caret_name;
        $caret->save();

        return redirect()->route('admin.caret.index')->with('success','Caret List Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caret = Caret::find($id);
        $caret->delete();

        return redirect()->back()->with('success','Caret List Delete Successfull');
    }
}
