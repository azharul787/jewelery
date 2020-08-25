<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Distric;
use App\Model\Upozila;

class UpozilaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $districs = Distric::orderBY('distric_name','ASC')->get();
        $show =  $request->show;
        if($show != ''){
            $upozilas = Upozila::latest()->paginate($show);
        }else{
            $upozilas = Upozila::latest()->paginate(10);
        }
        
        return view('backend.admin.upozila.index',compact('districs','upozilas'));
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
        $vlidate = request()->validate([
            'distric_name'=>'required',
            'upozila_name'=>'required',
        ]);
        $upozila = new Upozila();
        $upozila->distric_id = $request->distric_name;
        $upozila->upozila_name = $request->upozila_name;
        $upozila->save();

        return redirect()->route('admin.upozila.index')->with('success','Upozila Information Save Success');
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
        $districs = Distric::orderBy('distric_name','ASC')->get();
        $upozila = Upozila::find($id);
        $upozilas = Upozila::latest()->paginate(10);
        return view('backend.admin.upozila.edit',compact('districs','upozila','upozilas'));
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
        $vlidate = request()->validate([
            'distric_name'=>'required',
            'upozila_name'=>'required',
        ]);
        $upozila =  Upozila::find($id);
        $upozila->distric_id = $request->distric_name;
        $upozila->upozila_name = $request->upozila_name;
        $upozila->save();

        return redirect()->route('admin.upozila.index')->with('success','Upozila Information Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upozila = Upozila::find($id);
        $upozila->delete();

        return redirect()->route('admin.upozila.index')->with('success','Upozila Information Delete Success');
    }
}
