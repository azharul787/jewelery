<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Model\Unit;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Supplier;

class SupplierController extends Controller
{
    /*-----------ACL Base Role Permission system  @Azharul-------------------*/
    function __construct()
    {
         $this->middleware('permission:supplier-list');
         $this->middleware('permission:supplier-entry', ['only' => ['create','store']]);
         $this->middleware('permission:supplier-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
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
            $suppliers = Supplier::latest()->paginate($show);
        }else{
            $suppliers = Supplier::latest()->paginate(10);
        }
		
        return view('backend.admin.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.supplier.create');
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
            'supplier_name'=>'required',
            'phone'=>'required',
           // 'address'=>'required'
        ]);
        

        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();

        return redirect()->route('admin.supplier.index')->with('success','Supplier Information Save Successfull');

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
        $supplier = Supplier::find($id);
        $suppliers = Supplier::latest()->paginate(10);
        return view('backend.admin.supplier.edit',compact('supplier','suppliers'));
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
            'supplier_name'=>'required',
            'phone'=>'required',
            //'address'=>'required'
        ]);

        $supplier = Supplier::find($id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();

        return redirect()->route('admin.supplier.index')->with('success','Supplier Information Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
		$supplier = Supplier::find($id);
        $supplier->delete();

        return redirect()->back()->with('success','Supplier Information Successfully Deleted ');
    }
}
