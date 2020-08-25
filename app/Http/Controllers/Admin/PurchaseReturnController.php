<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\PurchaseDetail;
use App\Model\SaleReturnDetail;
use App\Model\PurchaseReturn;
use App\Model\PurchaseReturnDetail;
use App\Model\Account;
use App\Model\About;
use DB;

class PurchaseReturnController extends Controller
{
     /**
     * ACL by @Azharul
     */
    function __construct()
    {
         $this->middleware('permission:purchase-return-list');
         $this->middleware('permission:purchase-return-entry', ['only' => ['create','store']]);
         $this->middleware('permission:purchase-return-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:purchase-return-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $show = $request->show;
        if($show != ''){
            $purchases = PurchaseReturn::latest()->paginate($show);

        }else{
            $purchases = PurchaseReturn::latest()->paginate(10);

        }
        
        $suppliers = DB::select("SELECT DISTINCT purchases.supplier_id,suppliers.supplier_name FROM purchases, suppliers WHERE suppliers.id = purchases.supplier_id ");
        return view('backend.admin.purchase_return.index',compact('purchases','suppliers'));
    }
    /*--------------get chalan no section from ajax request----------------*/
    public function getChalanNo(Request $request){
        $chalan = DB::select("SELECT purchases.id,purchases.supplier_id,purchases.chalan_no from purchases where purchases.supplier_id = $request->id");
        return response()->json($chalan);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();
        $validate = request()->validate( [
            'supplier_name'=>'required',
            'chalan_no'=>'required',
        ]);
        $pd = Purchase::where('supplier_id',$request->supplier_name)->where('chalan_no',$request->chalan_no)->first();
        
        if($pd != NULL){
            //return $purchase;
            return view('backend.admin.purchase_return.create',compact('pd'));
        }
        else{
            return redirect()->back()->with('error','Woops! No Information Found, Please Check the Supplier Name Or Chalan No ');
        }
    }

    /**
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
            //return $data;
            $validate = request()->validate([
                'supplier_name'=>'required',
                'chalan_no'=>'required',
            ]);


            $purchase = new PurchaseReturn();
            $purchase->supplier_id = $request->supplier_id;
            $purchase->chalan_no = $request->chalan_no;
            $dt = Carbon::parse($request->return_date);
            $purchase->return_date =  $dt->toDateTimeString();
            $purchase->custom_cost = $request->custom_cost;
            $purchase->transport_cost = $request->transport_cost;
            $purchase->other_cost = $request->other_cost;
            $purchase->total_price = $request->grand_total;
            $purchase->discount = $request->discount;
            $purchase->payment = $request->payment;
            $purchase->note =  $request->note;
            $purchase->save();

            // supplier account data store
            /*$ca = new SupplierAccount();
            $ca->pay_date = $dt->toDateTimeString();
            $ca->supplier_id =  $request->supplier_name;
            $ca->purchase_id = $purchase->id;
            $ca->amount = $payment;
            $ca->note = $request->note;
            $ca->save();*/
        
            // purchase details section
            for($i = 0; $i<count($data['return_quantity']); $i++ ){
                if(!empty($data['return_quantity'][$i])){
                    /*--------------search purchase details for decrement stock-----------------*/
                    $pd = PurchaseDetail::find($data['purchase_detail_id'][$i]);

                    $list = new PurchaseReturnDetail();
                    $list->purchase_return_id = $purchase->id;
                    $list->purchase_detail_id =  $data['purchase_detail_id'][$i];
                    $list->warehouse_id =  $data['warehouse_id'][$i];
                    $list->product_id =  $data['product_id'][$i];
                    $list->supplier_id =  $request->supplier_id;
                    $list->category_id = $data['category_id'][$i];
                    $list->brand_id = $data['brand_id'][$i];
                    $list->unit_id = $data['unit_id'][$i];
                    $list->model_no = $data['model_no'][$i];
                    $list->rack_no = $data['rack_no'][$i];
                    $list->purchase_price = $data['purchase_price'][$i];
                    $list->return_price = $data['return_price'][$i];
                    $list->quantity = $data['return_quantity'][$i];
                    $list->return_date =  $dt->toDateTimeString();
                    $list->save();

                    /*-----------decrement purchase stock---------*/
                    $pd->now_stock = $pd->now_stock - $data['return_quantity'][$i];
                    $pd->save();
                }
            }
            return redirect()->route('admin.purchase_return.index')->with('success','Purchase return successfully save');
            
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
    public function supplierReturn($id)
    {
        $purchases = PurchaseReturn::where('supplier_id',$id)->paginate(100);
        $suppliers = DB::select("SELECT DISTINCT purchases.supplier_id,suppliers.supplier_name FROM purchases, suppliers WHERE suppliers.id = purchases.supplier_id ");
        return view('backend.admin.purchase_return.index',compact('purchases','suppliers'));
    }
    public function show($id)
    {
        $purchase = PurchaseReturn::find($id);
        return view('backend.admin.purchase_return.show',compact('purchase'));
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
        $rt = PurchaseReturn::find($id);
        $rt->delete();
        return redirect()->back()->with('success','Purchase Retrn delete Success');
    }
}
