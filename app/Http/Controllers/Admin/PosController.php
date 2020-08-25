<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\Distric;
use App\Model\Upozila;
use App\Model\Union;
use App\Model\Unit;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\PurchaseDetail;
use App\Model\Warehouse;
use App\Model\About;
use DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Sale::latest()->first();
        if($invoices != ''){
            $inv_no = date('dmy').$invoices->id + 1; 
        }
        else{
            $inv_no = date('dmy').'1';
        }
       // $districs = Distric::orderby('distric_name','ASC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
       // $customers = Customer::orderBy('customer_name','ASC')->get();
        //$customers = Customer::all('id','customer_name','distric_id','upozila_id');
        return view('backend.admin.pos.create',compact('categories','inv_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /*------barcode generate section */
    public function bar_qr(){
        $about = About::find(1);
        $warehouses = Warehouse::orderBy('warehouse_name','ASC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();

        $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->join('warehouses', 'purchase_stocks.warehouse_id', '=', 'warehouses.id')
                        ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                        ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                        ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                        ->select('purchase_stocks.*','warehouses.warehouse_name','purchase_stocks.now_stock as product_stock','products.product_name as product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                        ->get();
       return view('backend.admin.pos.bar_qr_list',compact('products','about','warehouses','categories','brands'));
    }
    public function barcode_generate(Request $request, $id){
        $about = About::find(1);
        $product = PurchaseDetail::find($id);
        return view('backend.admin.pos.barcode_generate',compact('about','product'));
    }
    public function qrcode_generate(Request $request, $id){
        $about = About::find(1);
        $product = PurchaseDetail::find($id);
        return view('backend.admin.pos.qrcode_generate',compact('about','product'));
    }
}
