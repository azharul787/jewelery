<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Distric;
use App\Model\Upozila;
use App\Model\Union;

class UnionController extends Controller
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
            $unions = Union::latest()->paginate($show);
        }
        else{
                $unions = Union::latest()->paginate(10);
        }
        
        return view('backend.admin.union.index',compact('districs','unions'));
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
    public function getUpozila(Request $request)
    {
        $upo = Upozila::where(['distric_id'=>$request->distric_id])->get();
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
        ]);
        $upozila = new Union();
        $upozila->upozila_id = $request->upozila_name;
        $upozila->union_name = $request->union_name;
        $upozila->save();

        return redirect()->route('admin.union.index')->with('success','Union Information Save Success');
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
        $union = Union::find($id);
        $unions = Union::latest()->paginate(10);
        return view('backend.admin.union.edit',compact('districs','union','unions'));
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
        $upozila =  Union::find($id);
        $upozila->upozila_id = $request->upozila_name;
        $upozila->union_name = $request->union_name;
        $upozila->save();

        return redirect()->route('admin.union.index')->with('success','Union Information Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $un = Union::find($id);
        $un->delete();

        return redirect()->route('admin.union.index')->with('success','Union Information Delete Success');
    }
}
