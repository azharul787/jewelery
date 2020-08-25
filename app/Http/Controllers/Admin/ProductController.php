<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Unit;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Type;
use App\Model\Caret;
use App\Model\Supplier;
use App\Model\Product;
use Auth;
use DB;

class ProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-list');
         $this->middleware('permission:product-entry', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
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
            $products = Product::latest()->paginate($show);
        }
       else{
        $products = Product::latest()->paginate(15);
       }
        return view('backend.admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $units = Unit::orderBy('unit_name','ASC')->get();
        $types = Type::orderBy('type_name','ASC')->get();
        $carets = Caret::orderBy('caret_name','ASC')->get();
        $suppliers = Supplier::orderBy('supplier_name','ASC')->get();
        return view('backend.admin.product.create',compact('suppliers','categories','brands','units','types','carets'));
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
            'product_name'=>'required',
            'model_no' => 'required|unique:products,model_no',
            'brand_name'=>'required',
            'category_name'=>'required',
            'type_name'=>'required',
            'unit_name'=>'required',
            'supplier_name'=>'required',
            're_order_label'=>'required',
        ]);
        

         $product = new Product();
         $product->product_name = $request->product_name;
         $product->model_no = $request->model_no;
         $product->category_id = $request->category_name;
         $product->type_id = $request->type_name;
         $product->caret_id = $request->caret_name;
         $product->brand_id = $request->brand_name;
         $product->supplier_id = $request->supplier_name;
         $product->unit_id = $request->unit_name;
         $product->supplier_price = $request->supplier_price;
         $product->sale_price = $request->sale_price;
         $product->re_order_label = $request->re_order_label;
         $product->save();

         return redirect()->route('admin.product.index')->with('success','Product Information save Success');

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
        $product = Product::find($id);
        $categories = Category::orderBy('category_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $units = Unit::orderBy('unit_name','ASC')->get();
        $types = Type::orderBy('type_name','ASC')->get();
        $carets = Caret::orderBy('caret_name','ASC')->get();
        $suppliers = Supplier::orderBy('supplier_name','ASC')->get();
        return view('backend.admin.product.edit',compact('product','brands','categories','units','suppliers','types','carets'));
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
            'product_name'=>'required',
            'model_no'=>'required|unique:products,model_no,'.$id,
            'brand_name'=>'required',
            'category_name'=>'required',
            'unit_name'=>'required',
            'supplier_name'=>'required',
            're_order_label'=>'required',
        ]);
        
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->model_no = $request->model_no;
        $product->category_id = $request->category_name;
        $product->brand_id = $request->brand_name;
        $product->type_id = $request->type_name;
        $product->caret_id = $request->caret_name;
        $product->supplier_id = $request->supplier_name;
        $product->unit_id = $request->unit_name;
        $product->supplier_price = $request->supplier_price;
        $product->sale_price = $request->sale_price;
        $product->re_order_label = $request->re_order_label;
        $product->created_by = Auth::id();
        $product->save();

         return redirect()->route('admin.product.index')->with('success','Product Information Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('success','Product Information Successfully Deleted');
    }

}
