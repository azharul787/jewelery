<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Category;

class BrandController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:brand-list');
         $this->middleware('permission:brand-entry', ['only' => ['create','store']]);
         $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
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
            $brands = Brand::latest()->paginate($show);
        }else{
            $brands = Brand::latest()->paginate(10);
        }
		
        return view('backend.admin.brand.index',compact('brands'));
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
            'brand_name'=>'required|unique:brands'
            ]);
            
            $brand = new Brand();
            $brand->brand_name = $request->brand_name;
            $brand->save();
            

            return redirect()->route('admin.brand.index')->with('success','Brand List Save Successfull');
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
        $brand = Brand::find($id);
        $brands = Brand::latest()->paginate(10);

        return view('backend.admin.brand.edit',compact('brands','brand'));
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
            'brand_name'=>'required'
        ]);
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success','Brand List Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect()->back()->with('success','Brand List Delete Successfull');
    }
}
