<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Model\Unit;
use App\Model\Brand;
use App\Model\Type;
use App\Model\Caret;
use App\Model\Warehouse;
use App\Model\Product;
use App\Model\RawPurchase;
use App\Model\RawPurchaseDetail;
use App\Model\Supplier;
use App\Model\SupplierAccount;
use App\Model\CustomerAccount;
use App\Model\Loan;
use App\Model\BankTransaction;
use App\Model\Expense;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\CashClosing;
use DB;

class RawPurchaseController extends Controller
{
    /**
     * ACL by @Azharul
     */
    function __construct()
    {
         $this->middleware('permission:purchase-list');
         $this->middleware('permission:purchase-entry', ['only' => ['create','store']]);
         $this->middleware('permission:purchase-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:purchase-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $show = $request->show;
        if($show != ''){
            $purchases = RawPurchase::latest()->paginate($show);
        }
        else{
            $purchases = RawPurchase::latest()->paginate(15);
        }
        return view('backend.admin.raw_purchase.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carets = Caret::orderBy('caret_name','ASC')->get();
        $types = Type::orderBy('type_name','ASC')->get();
        $suppliers = Supplier::orderBy('supplier_name','ASC')->get();

        $invoices = RawPurchase::latest()->first();
        if($invoices != ''){
            $inv_no = date('dmy').$invoices->id + 1; 
        }
        else{
            $inv_no = date('dmy').'1';
        }
        return view('backend.admin.raw_purchase.create',compact('suppliers','carets','types','inv_no'));
    }

    /**
     * get data from ajax request
     * 
     * 
     */
    /**
     * ajax request section
     */
    /*----------Supplier list for ajax Section------------------*/
    public function supplierList(){
        $suppliers = Supplier::orderBy('supplier_name','ASC')->get();
        return response()->json($suppliers);
    }
    public function productList(Request $request){
       	$test = Product::where('type_id', $request->type)->get();
        return response()->json($test);
    }
    public function productDetails(Request $request){
       	$test = Product::with('category','brand','unit')->find($request->id);
        return response()->json($test);
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        /*-----------check cash closing------------*/
      /*  $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d'))->exists();
        if($closing != true){
            /*----------check current balance--------*/
     /*       $closing_date =  date('Y-m-d',strtotime($request->purchase_date));

           $cus_pay = CustomerAccount::whereDate('ca_date', $closing_date)->sum('amount');
           $lo_receive = Loan::whereDate('transaction_date',$closing_date)->sum('credit');
           $bank_wit = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Withdraw')->sum('transaction_amount');
           /*------payment from clients------------*/
    /*       $sup_pay = SupplierAccount::whereDate('pay_date', $closing_date)->sum('amount');
           $lo_pay = Loan::whereDate('transaction_date',$closing_date)->sum('debit');
           $expense = Expense::whereDate('expense_date',$closing_date)->sum('expense_amount');
           $bank_depo = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Deposit')->sum('transaction_amount');

           /*-----lastday cash-----------*/
    /*        $lastday_cash = CashClosing::whereDate('closing_date', '<=', $closing_date)->latest('closing_date')->first();

           $receipt = $cus_pay + $lo_receive + $bank_wit;
           $payment = $sup_pay + $lo_pay + $bank_depo + $expense;
           $balance = $lastday_cash->balance + $receipt - $payment;
           /*-----lastday cash-----------*/

    /*    if($balance > $request->payment){*/
            $data = $request->except('_token','submit');
            // return $data;
                 request()->validate([
                // 'product_id'=>'required',
                    'supplier_name'=>'required',
                    'chalan_no'=>'required|unique:raw_purchases',
                // 'total_purchase_price'=>'required',
                ]);

                $purchase = new RawPurchase();
                $purchase->supplier_id = $request->supplier_name;
                $purchase->chalan_no = $request->chalan_no;
                $dt = Carbon::parse($request->purchase_date);
                $purchase->purchase_date =  $dt->toDateTimeString();
                $purchase->per_10_gram_price = $request->grand_total;
                $purchase->per_gram_price = $request->custom_cost;
                $purchase->total_weight = $request->total_weight;
                $purchase->total_purchase_price = $request->total_purchase_price;
                $purchase->total_quantity = $request->total_quantity;
                $purchase->discount = $request->discount;
                $purchase->grand_total = $request->grand_total;
                $purchase->payment = $request->payment;
                $purchase->due_amount = $request->due;
                $purchase->note =  $request->note;
                $purchase->save();

                // supplier account data store
                $ca = new SupplierAccount();
                $ca->pay_date = $dt->toDateTimeString();
                $ca->supplier_id =  $request->supplier_name;
                $ca->purchase_id = $purchase->id;
                $ca->amount = $request->payment;
                $ca->note = $request->note;
                $ca->save();
            
                // purchase details section
                for($i = 0; $i<count($data['product_id']); $i++ ){
                        /*-------------find product information------------------*/
                      $product = Product::find($data['product_id'][$i]);

                        $list = new RawPurchaseDetail();
                        $list->purchase_id = $purchase->id;
                        $list->warehouse_id = 1;// $data['warehouse'][$i];
                        $list->product_id =  $data['product_id'][$i];
                        $list->supplier_id =  $request->supplier_name;
                        $list->category_id = $product->category_id;
                        $list->brand_id = $product->brand_id;
                        $list->type_id = $product->type_id;
                        $list->unit_id = $product->unit_id;
                        $list->caret_id = $data['caret_id'][$i];
                        $list->code_no = $data['code_no'][$i];
                       // $list->rack_no = $data['rack_no'][$i];
                        $list->weight = $data['weight'][$i];
                        $list->per_gram_price = $data['per_gram'][$i];
                        $list->purchase_price = $data['purchase_price'][$i];
                        $list->sale_price = $data['sale_price'][$i];
                        $list->quantity = $data['ordered_quantity'][$i];
                        $list->now_stock = $data['ordered_quantity'][$i];
                        $list->purchase_date =  $dt->toDateTimeString();
                        $list->save();
                    }


            return redirect()->route('admin.purchase.index')->with('success','Product Purchase Save Success');
/*        }
        else{
            return redirect()->route('admin.purchase.create')->with('error','Woops! current balance is not enough for this transaction , please check cuurent balance from cash module.');
        }
        }
        else{
            return redirect()->route('admin.purchase.create')->with('error','Woops! After cash closing all transaction has been stoped');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function supplierSale($id)
    {
        $purchases = RawPurchase::where('supplier_id',$id)->paginate(10);
        return view('backend.admin.purchase.index',compact('purchases'));
    }
    /**
     * 
     */
    public function show($id)
    {
        $purchase = RawPurchase::find($id);
        return view('backend.admin.purchase.show',compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $purchase = RawPurchase::find($id);
        return view('backend.admin.purchase.edit',compact('purchase'));
    }

    /*****
     * 
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d'))->exists();

        if($closing != true){
            $data = $request->except('_token','submit');

            // return $data;
            $validate = request()->validate([
                // 'product_id'=>'required',
                //'supplier_name'=>'required',
                'chalan_no'=>'required|unique:purchases,chalan_no,'.$id,
                // 'total_purchase_price'=>'required',
                
            ]);
    
    
            $purchase =  RawPurchase::find($id);
            //$purchase->supplier_id = $request->supplier_name;
            //$purchase->chalan_no = $request->chalan_no;
            //$purchase->order_id = $request->order_id;
            $dt = Carbon::parse($request->purchase_date);
            $purchase->purchase_date =  $dt->toDateTimeString();
            $purchase->total_purchase_price = $request->grand_total;
            $purchase->custom_cost = $request->custom_cost;
            $purchase->transport_cost = $request->transport_cost;
            $purchase->other_cost = $request->other_cost;
            $purchase->discount = $request->discount;
            $purchase->net_purchase_price = $request->grand_total;
            $payment = $request->previous_pament + $request->payment;
            $purchase->payment = $payment;
            if($request->grand_total >= $payment)
            {
                $purchase->payment_status = 'Due';
            }
            else{
                $purchase->payment_status = 'Paid'; 
            }
            $purchase->due_amount = $request->due ;
            $purchase->note =  $request->note;
            
    
            // supplier account data store
            $ca =  SupplierAccount::where('pay_date',$purchase->purchase_date)->where('supplier_id',$purchase->supplier_id)->where('purchase_id',$id)->where('amount',$purchase->payment)->first();
            if(!empty($ca)) {
                    $ca->pay_date = $dt->toDateTimeString();
                    $ca->amount = $payment;
                    $ca->note = $request->note;
                    $ca->save();
                    
                }
                else{
                    $ca = new SupplierAccount();
                    $ca->pay_date = $dt->toDateTimeString();
                    $ca->supplier_id =  $purchase->supplier_id;
                    $ca->purchase_id = $purchase->id;
                    $ca->amount = $payment;
                    $ca->note = $request->note;
                    $ca->save();
                }
            /*-------------purchase information save after save supplier account save---------------*/
            $purchase->save();
            // purchase details section
            for($i = 0; $i<count($data['product_id']); $i++ ){
                    /*-------------find product information------------------*/
                    $list =  RawPurchaseDetail::find($data['purchase_detail_id'][$i]);

                    //$list->purchase_id = $purchase->id;
                    //$list->warehouse_id =  $data['warehouse'][$i];
                    //$list->product_id =  $data['product_id'][$i];
                    //$list->supplier_id =  $request->supplier_name;
                    //$list->category_id = $data['category_id'][$i];
                // $list->brand_id = $data['brand_id'][$i];
                    //$list->unit_id = $data['unit_id'][$i];
                    $list->purchase_price = $data['supplier_price'][$i];
                    //$list->model_no = $data['model_no'][$i];
                    $list->purchase_price = $data['supplier_price'][$i];
                    $list->sale_price = $data['sale_price'][$i];
                    $list->quantity = $data['ordered_quantity'][$i];
                    $list->now_stock = $data['ordered_quantity'][$i];
                    $list->purchase_date =  $dt->toDateTimeString();
                    $list->save();
                }
            /*----------change order status-------------*/
                $order = Order::find($purchase->order_id);
                $order->stock_in_date =  $dt->toDateTimeString();
                $order->status = 'Stocked';
                $order->updated_by = Auth::id();
                $order->save();
            /*-----------------------------------*/
    
         return redirect()->route('admin.purchase.index')->with('success','Product Purchase Update Success'); 
        }
        else{
            return redirect()->back()->with('error','Woops! After cash closing all transaction has been stoped');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();

        return redirect()->back()->with('success','RawPurchase List Delete Success');
    }
}
