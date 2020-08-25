<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Warehouse;
use App\Model\About;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Supplier;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use DB;

class StockController extends Controller
{
    /*--------stock list product wise----------*/
    public function stocklist(){
        $about = About::find(1);
        $warehouse = '';

        $products  = DB::table('product_stocks')
                ->join('products', 'product_stocks.product_id', '=', 'products.id')
                ->join('categories', 'product_stocks.category_id', '=', 'categories.id')
                ->join('brands', 'product_stocks.brand_id', '=', 'brands.id')
                ->join('units', 'product_stocks.unit_id', '=', 'units.id')
                ->select('product_stocks.*','products.product_name','products.model_no', 'categories.category_name', 'brands.brand_name','units.unit_name')
                ->get();   

        return view('backend.admin.stock.stockList',compact('about','warehouse','products'));
    }
     /*----------stock search------------*/
     public function stocks(Request $request){
          $about = About::find(1);
          $warehouses = Warehouse::orderBy('warehouse_name','ASC')->get();
          $warehouse =''; 
  
          $search_by = $request->search_by;
          $search_value = $request->search_value;
        
          $products  = DB::table('purchase_stocks')
                  ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                  ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                  ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                  ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                  ->select('purchase_stocks.*','purchase_stocks.now_stock as product_stock','products.product_name as product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                  ->where('purchase_stocks.'.$search_by ,$search_value)
                  ->get(); 
          return view('backend.admin.stock.stockList',compact('products','about','warehouses','warehouse'));
      }
    /*--------warehouse stock list-------------*/
    public function wstock($id){
        $about = About::find(1);
        $warehouse = Warehouse::find($id); 

        $products  = DB::table('purchase_stocks')
                ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                ->select('purchase_stocks.*','purchase_stocks.now_stock as product_stock','products.product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                ->where('warehouse_id',$id)
                ->get();   

        return view('backend.admin.stock.stockList',compact('products','about','warehouse'));
    }
   /*=========================filtering section================================*/
    /*---------------------------Total Stock List--------------------------------*/
    public function tsList(){
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
       return view('backend.admin.stock.filterStock',compact('products','about','warehouses','categories','brands'));
    }
    /*----------------------------warehouse product List ------------------------*/
    public function wpList(Request $request){
        $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->join('warehouses', 'purchase_stocks.warehouse_id', '=', 'warehouses.id')
                        ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                        ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                        ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                        ->select('purchase_stocks.*','warehouses.warehouse_name','purchase_stocks.now_stock as product_stock','products.product_name as product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                        ->where('purchase_stocks.warehouse_id' ,$request->warehouse)
                        ->get();
        return response()->json($products);
    }
    /*----------------------------category wise product stock search------------------------*/
    public function cpList(Request $request){
        $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->join('warehouses', 'purchase_stocks.warehouse_id', '=', 'warehouses.id')
                        ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                        ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                        ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                        ->select('purchase_stocks.*','warehouses.warehouse_name','purchase_stocks.now_stock as product_stock','products.product_name as product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                        ->where('purchase_stocks.category_id' ,$request->category)
                        ->get();
        return response()->json($products);
    }
    /*----------------------------brand wise stock search------------------------*/
    public function bpList(Request $request){
        $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->join('warehouses', 'purchase_stocks.warehouse_id', '=', 'warehouses.id')
                        ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                        ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                        ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                        ->select('purchase_stocks.*','warehouses.warehouse_name','purchase_stocks.now_stock as product_stock','products.product_name as product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                        ->where('purchase_stocks.brand_id' ,$request->brand)
                        ->get();
        return response()->json($products);
    }
    /*----------------------------brand wise stock search------------------------*/
    public function pList(Request $request){
        $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->join('warehouses', 'purchase_stocks.warehouse_id', '=', 'warehouses.id')
                        ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                        ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                        ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                        ->select('purchase_stocks.*','warehouses.warehouse_name','purchase_stocks.now_stock as product_stock','products.product_name as product_name','products.model_no','products.re_order_label', 'categories.category_name', 'brands.brand_name','units.unit_name')
                        ->where('purchase_stocks.product_id' ,$request->product)
                        ->get();
        return response()->json($products);
    }
    /*--------------------stock Transfer search-----------------------------------*/
    public function stock_transfer(Request $request){

        $warehouses = Warehouse::active()->orderBy('warehouse_code','ASC')->get();
        
        return view('backend.admin.stock.transfer_search',compact('warehouses'));
    }
    /*----------ajax request section-------------*/
    public function spList(Request $request){
        $products = DB::table('purchase_stocks')
                ->select('purchase_stocks.id as id','purchase_stocks.product_name','purchase_stocks.model_no')
                ->where('warehouse_id',$request->id)
                ->get();
        return response()->json($products);
    }
    public function spDetails(Request $request)
    {
        $product  = DB::table('purchase_stocks')
                ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                ->join('warehouses', 'purchase_stocks.warehouse_id', '=', 'warehouses.id')
                ->select('purchase_stocks.*','purchase_stocks.id as purchase_detail_id','warehouses.warehouse_name')
                ->where('purchase_stocks.id',$request->id)
            ->first();
       /* $product = Product::find($request->id);*/
        return response()->json($product);
    }
    public function sptupdate(Request $request)
    {
        $data = $request->except('_token','submit');

        for($i = 0; $i<count($data['purchase_detail_id']); $i++ ){
            $pur = PurchaseDetail::find($data['purchase_detail_id'][$i]);
            $pur->warehouse_id = $data['warehouse_id'][$i];
            $pur->rack_no = $data['rack_no'][$i];
            $pur->save();
            $pur->updated_by = Auth::id();
        }
        return redirect()->route('admin.stock.stocklist')->with('success','Stock Transfer Successful');
    }
}
