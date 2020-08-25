<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Model\Category;
use App\Model\Product;
use App\Model\Warehouse;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\WastageReturn;
use App\Model\WastageReturnDetail;
use App\Model\PurchaseDetail;
use App\Model\SaleReturnDetail;
use App\Model\PurchaseReturn;
use App\Model\PurchaseReturnDetail;
use App\Model\Account;
use App\Model\About;
use DB;

class WastageReturnController extends Controller
{
    /**
     * ACL by @Azharul
     */
    function __construct()
    {
         $this->middleware('permission:wastage-return-list');
         $this->middleware('permission:wastage-return-entry', ['only' => ['create','store']]);
         $this->middleware('permission:wastage-return-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:wastage-return-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $show = $request->show;
        if($show != ''){
            $wastages = WastageReturn::latest()->paginate($show);
        }else{
            $wastages = WastageReturn::latest()->paginate(10);
        }

        return view('backend.admin.wastage_return.index',compact('wastages'));
    }
    /*--------------*/
    public function srList($id){
        $wastages = WastageReturn::where('supplier_id',$id)->latest()->paginate(10);
        return view('backend.admin.wastage_return.index',compact('wastages'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $warehouses = Warehouse::orderBy('warehouse_name',"ASC")->get();
        return view('backend.admin.wastage_return.create',compact('warehouses'));

    }
    /*---------------------------*/
    public function productList3(Request $request){
        $products = DB::select("SELECT DISTINCT products.product_name,purchase_details.id, purchase_details.model_no,purchase_details.warehouse_id FROM `products`, `warehouses`, `purchase_details` WHERE purchase_details.product_id = products.id AND purchase_details.warehouse_id  = $request->warehouse AND purchase_details.now_stock > 0 ");
        return response()->json($products);
    }
    /*--------------------*/
    public function productDetails3(Request $request)
    {
       	$test = PurchaseDetail::with('category','product','brand','unit','warehouse')->find($request->id);
        return response()->json($test);
    }
    /**q
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d'))->exists();
        if($closing != true){

            $data = $request->except('_token','submit');
            
            for($i = 0; $i<count($data['return_quantity']); $i++ ){
                /*--------------search purchase details for decrement stock-----------------*/
                $pd = PurchaseDetail::find($data['purchase_detail_id'][$i]);

                $list = new WastageReturn();
                $list->purchase_detail_id =  $data['purchase_detail_id'][$i];
                $list->warehouse_id =  $pd->warehouse_id;
                $list->product_id =  $data['product_id'][$i];
                $list->supplier_id =  $pd->supplier_id;
                $list->category_id = $data['category_id'][$i];
                $list->brand_id = $data['brand_id'][$i];
                $list->unit_id = $data['unit_id'][$i];
                $list->model_no = $data['model_no'][$i];
                $list->rack_no = $data['rack_no'][$i];
                $list->purchase_price = $pd->purchase_price;
                $list->return_price = $data['return_price'][$i];
                $list->return_quantity = $data['return_quantity'][$i];
                $dt = Carbon::parse($request->return_date);
                $list->return_date =  $dt->toDateTimeString();
                $list->save();

                /*-----------decrement purchase stock---------*/
                $pd->now_stock = $pd->now_stock - $data['return_quantity'][$i];
                $pd->save();
            }
            return redirect()->route('admin.wastage_return.index')->with('success','Wastage return successfully save');
        }
        else{
            return redirect()->back()->with('error','Woops! After cash closing all transaction has been stoped');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wastages = WastageReturn::where('product_id',$id)->latest()->paginate(10);
        return view('backend.admin.wastage_return.index',compact('wastages'));
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
}
