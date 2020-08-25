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
use App\Model\SaleReturn;
use App\Model\SaleReturnDetail;
use App\Model\Account;
use App\Model\About;
use DB;

class SaleReturnController extends Controller
{
     /**
     * ACL by @Azharul
     */
    function __construct()
    {
         $this->middleware('permission:sale-return-list');
         $this->middleware('permission:sale-return-entry', ['only' => ['create','store']]);
         $this->middleware('permission:sale-return-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sale-return-delete', ['only' => ['destroy']]);
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
            $sales = SaleReturn::latest()->paginate($show);
        }else{
            $sales = SaleReturn::latest()->paginate(10);
        }
        $customers = DB::select("SELECT DISTINCT sales.customer_id,customers.customer_name FROM sales, customers WHERE customers.id = sales.customer_id");
        return view('backend.admin.sale_return.index',compact('sales','customers'));
    }
    /*--------------get invoice no section from ajax request----------------*/
    public function getInvoiceNo(Request $request){
        $invoice = DB::select("SELECT sales.id,sales.customer_id,sales.invoice_no from sales where sales.customer_id = $request->id");
        return response()->json($invoice);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate = request()->validate( [
            'customer_name'=>'required',
            'invoice_no'=>'required',
        ]);
        $sl = Sale::where('customer_id',$request->customer_name)->where('invoice_no',$request->invoice_no)->first();
        
        if($sl != NULL){
            //return $purchase;
            return view('backend.admin.sale_return.create',compact('sl'));
        }
        else{
            return redirect()->back()->with('error','Woops! No Information Found, Please Check the Customer Name Or Invoice No ');
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
                'customer_name'=>'required',
                'invoice_no'=>'required',
            ]);


            $sale = new SaleReturn();
            $sale->customer_id = $request->customer_id;
            $sale->invoice_no = $request->invoice_no;
            $dt = Carbon::parse($request->return_date);
            $sale->return_date =  $dt->toDateTimeString();
            $sale->total_price = $request->total_price;
            $sale->discount = $request->discount;
            $sale->grand_total_price = $request->grand_total;
            $sale->payment = $request->payment;
            $sale->note =  $request->note;
            $sale->save();

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
                    $pd = SaleDetail::find($data['sale_detail_id'][$i]);

                    $list = new SaleReturnDetail();
                    $list->sale_return_id = $sale->id;
                    $list->sale_detail_id =  $data['sale_detail_id'][$i];
                    $list->warehouse_id =  $data['warehouse_id'][$i];
                    $list->product_id =  $data['product_id'][$i];
                    $list->customer_id =  $request->customer_id;
                    $list->category_id = $data['category_id'][$i];
                    $list->brand_id = $data['brand_id'][$i];
                    $list->unit_id = $data['unit_id'][$i];
                    $list->model_no = $data['model_no'][$i];
                    $list->rack_no = $data['rack_no'][$i];
                    $list->return_price = $data['return_price'][$i];
                    $list->quantity = $data['return_quantity'][$i];
                    $list->return_date =  $dt->toDateTimeString();
                    $list->save();

                    /*-----------decrement Sale return quantity ---------*/
                    $pd->return_qty =  $data['return_quantity'][$i];
                    $pd->save();
                }
            }
            return redirect()->route('admin.sale_return.index')->with('success','Sale return successfully save');
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
    public function customerReturn($id)
    {
        $sales = SaleReturn::where('customer_id',$id)->paginate(100);
        $customers = DB::select("SELECT DISTINCT sales.customer_id,customers.customer_name FROM sales, customers WHERE customers.id = sales.customer_id");
        return view('backend.admin.sale_return.index',compact('sales','customers'));
    }
    public function show($id)
    {
        $sale = SaleReturn::find($id);
        return view('backend.admin.sale_return.show',compact('sale'));
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
