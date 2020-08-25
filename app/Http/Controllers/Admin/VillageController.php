<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Distric;
use App\Model\Upozila;
use App\Model\Union;
use App\Model\Village;

class VillageController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $districs = Distric::orderBY('distric_name','ASC')->get();
        $show =  $request->show;
        if($show != ''){
            $villages = Village::latest()->paginate($show);
        }
        else{
            $villages = Village::latest()->paginate(10);
        }
        
        return view('backend.admin.village.index',compact('districs','villages'));
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

    /*
        get upozila list from ajax request
    */
    public function getUnion(Request $request)
    {
        $upo = Union::where(['upozila_id'=>$request->upozila_id])->get();
        return response()->json($upo);
    }
    public function getVillage(Request $request)
    {
        $upo = Village::where(['union_id'=>$request->union_id])->get();
        return response()->json($upo);
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
            'union_name'=>'required',
            'village_name'=>'required',
        ]);
        $upozila = new Village();
        $upozila->union_id = $request->union_name;
        $upozila->village_name = $request->village_name;
        $upozila->save();

        return redirect()->route('admin.village.index')->with('success','Village Information Save Success');
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
        $village = Village::find($id);
        $villages = Village::latest()->paginate(10);
        return view('backend.admin.village.edit',compact('districs','village','villages'));
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
            'union_name'=>'required',
        ]);
        $upozila =  Village::find($id);
        $upozila->union_id = $request->union_name;
        $upozila->village_name = $request->village_name;
        $upozila->save();

        return redirect()->route('admin.village.index')->with('success','Village Information Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $un = Village::find($id);
        $un->delete();

        return redirect()->route('admin.village.index')->with('success','Union Information Delete Success');
    }
}
