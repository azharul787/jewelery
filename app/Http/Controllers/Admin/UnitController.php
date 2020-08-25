<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Unit;
use App\Model\Category;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show = $request->show;
        if($show != ''){
            $units = Unit::latest()->paginate($show);
        }else{
            $units = Unit::latest()->paginate(10);
        }
		
        return view('backend.admin.unit.index',compact('units'));
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
            'unit_name'=>'required|unique:units'
        ]);

        $unit = new Unit();
        $unit->unit_name = $request->unit_name;
        $unit->save();

        return redirect()->route('admin.unit.index')->with('success','Unit List Save Succes');
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
        $unit = Unit::find($id);
        $units = Unit::latest()->paginate(10);
        return view('backend.admin.unit.edit',compact('unit','units'));
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
            'unit_name'=>'required',
        ]);

        $unit = Unit::find($id);
        $unit->unit_name = $request->unit_name;
        $unit->save();

        return redirect()->route('admin.unit.index')->with('success','Unit List Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->back()->with('success','Unit Delete Success');
    }
}
