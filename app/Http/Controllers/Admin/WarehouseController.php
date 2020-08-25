<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Warehouse;

class WarehouseController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:warehouse-list');
         $this->middleware('permission:warehouse-entry', ['only' => ['create','store']]);
         $this->middleware('permission:warehouse-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:warehouse-delete', ['only' => ['destroy']]);
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
            $warehouses = Warehouse::latest()->paginate($show);
        }
        else{
            $warehouses = Warehouse::latest()->paginate(10);
        }
        return view('backend.admin.warehouse.index',compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.warehouse.create');
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
            'warehouse_name' =>'required',
            'warehouse_code' =>'required|unique:warehouses',
        ]);

        $warehouse  = new Warehouse();
        $warehouse->user_id = Auth::id();
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->warehouse_code = $request->warehouse_code;
        $warehouse->warehouse_phone = $request->warehouse_phone;
        $warehouse->warehouse_email = $request->warehouse_email;
        $warehouse->warehouse_location = $request->warehouse_location;
        $warehouse->created_by = Auth::id();
        $warehouse->save();

        return redirect()->back()->with('success','Warehouse Information Save Successfull');
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
        $warehouse = Warehouse::find($id);
        $warehouses = Warehouse::orderBy('warehouse_code','ASC')->paginate(10);

        return view('backend.admin.warehouse.edit',compact('warehouse','warehouses'));
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
            'warehouse_name' =>'required',
            'warehouse_code' =>'required|unique:warehouses,warehouse_code,'.$id,
        ]);

        $warehouse  = Warehouse::find($id);
        $warehouse->user_id = Auth::id();
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->warehouse_code = $request->warehouse_code;
        $warehouse->warehouse_phone = $request->warehouse_phone;
        $warehouse->warehouse_email = $request->warehouse_email;
        $warehouse->warehouse_location = $request->warehouse_location;
        $warehouse->updated_by = Auth::id();
        $warehouse->save();

        return redirect()->route('admin.warehouse.index')->with('success','Warehouse Information Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();

        return redirect()->back()->with('success','Warehouse Information Delete Successfull');
    }
}
