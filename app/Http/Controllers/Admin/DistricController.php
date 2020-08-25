<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Distric;

class DistricController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:district-list');
         $this->middleware('permission:district-entry', ['only' => ['create','store']]);
         $this->middleware('permission:district-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:district-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show =  $request->show;
        if($show != ''){
            $districs = Distric::latest()->paginate($show);
        }
            else{
                $districs = Distric::latest()->paginate(10);
            }
        
        return view('backend.admin.distric.index',compact('districs'));
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
        ]);
        $distric = new Distric();
        $distric->distric_name = $request->distric_name;
        $distric->save();

        return redirect()->route('admin.distric.index')->with('success','Distric Information Save Success');
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
        $distric = Distric::find($id);
        $districs = Distric::latest()->paginate(10);
        return view('backend.admin.distric.edit',compact('distric','districs'));
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
        ]);
        $distric =  Distric::find($id);
        $distric->distric_name = $request->distric_name;
        $distric->save();

        return redirect()->route('admin.distric.index')->with('success','Distric Information Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distric = Distric::find($id);
        $distric->delete();

        return redirect()->route('admin.distric.index')->with('success','Distric Information Delete Success');
    }
}
