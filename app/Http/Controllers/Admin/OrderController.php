<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Model\Unit;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Type;
use App\Model\Caret;
use App\Model\Product;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\Account;
use DB;

class OrderController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:order-list');
         $this->middleware('permission:order-entry', ['only' => ['create','store']]);
         $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:order-delete', ['only' => ['destroy']]);
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
            $orders = Order::where('status','Pending')->latest()->paginate($show);
        }
        else{
            $orders = Order::where('status','Pending')->latest()->paginate(10);
        }
       
        return view('backend.admin.order.index',compact('orders'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $types = Type::orderBy('type_name','ASC')->get();
        $carets = Caret::orderBy('caret_name','ASC')->get();
        $invoices = Order::latest()->first();
        if($invoices != ''){
            $order_no = date('dmy').$invoices->id + 1; 
        }
        else{
            $order_no = date('dmy').'1';
        }
        return view('backend.admin.order.create',compact('types','order_no','carets'));
    }
    /*--------*/
    public function productList5(Request $request){
        $test = Product::where('type_id', $request->type)->get();
        return response()->json($test);
    }
    public function productDetails5(Request $request){
        $test = Product::with('category','type','unit')->find($request->id);
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
        $this->validate($request,[
             'order_date'=>'required',
             'delivery_date'=>'required',
             'order_no'=>'required|unique:orders,order_no',
         ]);
 
        $data = $request->except('_token','submit');
        //return $data;
         $order = new Order();
         $order->order_no = $request->order_no;
        if($request->customer_id == NULL){
            $customer = new Customer();
            $customer->customer_name = $request->customer_name;
            $customer->customer_phone = $request->customer_phone;
            $customer->customer_address = $request->address;
            $customer->save();

            $order->customer_id = $customer->id;
        }else{
            $order->customer_id = $request->customer_id;
        }

        $order->user_id = Auth::id();
        $order->gross_price = $request->gross_price;
        $order->per_rote_price = $request->per_rote_price;
        $order->total_weight = $request->total_weight;
        $order->total_wage = $request->total_wage;
        $order->total_price = $request->total_price;
        $order->discount = $request->discount;
        $order->grand_total = $request->grand_total;
        $order->payment = $request->payment;
        $order->due_amount = $request->due;
        $dt = Carbon::parse($request->order_date);
        $order->order_date =  $dt->toDateTimeString();
        $order->delivery_date =  date('Y-m-d',strtotime($request->delivery_Date));
        $order->created_by = Auth::id();
        $order->save();
 
         // customer account data store
         $ca = new CustomerAccount();
         $ca->ca_date = $dt->toDateTimeString();
         $ca->customer_id =  $order->customer_id;
         $ca->order_id = $order->id;
         $ca->amount = $request->payment;
         $ca->note = $request->note;
         $ca->save();
     
         // order details section
         for($i = 0; $i<count($data['product_id']); $i++ ){
 
                $product = Product::find($data['product_id'][$i]);

                $list = new OrderDetail();
                $list->order_id = $order->id;
                $list->user_id = Auth::id();
                $list->product_id =  $data['product_id'][$i];
                $list->category_id =  $product->category_id;
                $list->type_id = $product->type_id;
                $list->caret_id = $data['caret_id'][$i];
                $list->order_no = $request->order_no;
                $list->weight = $data['weight'][$i];
                $list->wage = $data['wage'][$i];
                $list->sub_total = ($data['weight'][$i] * $request->per_rote_price) + $data['wage'][$i];
                $list->order_date =  $dt->toDateTimeString();
                $list->created_by = Auth::id();
                $list->save();
             }

             return redirect()->route('admin.order.index')->with('success','Order Save Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerOrder($id)
    {
        $orders = Order::where('customer_id',$id)->paginate(10);
        return view('backend.admin.order.customerOrder',compact('orders'));
    }
    /*------------*/
    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.admin.order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$categories = Category::orderBy('category_name','ASC')->get();
       // $suppliers = Supplier::orderBy('supplier_name','ASC')->get();
        $order = Order::find($id);

        return view('backend.admin.order.edit',compact('order'));
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
            // 'product_id'=>'required',
            // 'supplier_name'=>'required',
             'order_no'=>'required|unique:orders,order_no,'.$id,
            // 'total_order_price'=>'required',
            
         ]);
 
        $data = $request->except('_token','submit');
        
        $order =  Order::find($id);
        $order->user_id = Auth::id();
        //$order->supplier_id = $request->supplier_name;
       // $order->order_no = $request->order_no;
        $dt = Carbon::parse($request->order_date);
        $order->order_date =  $dt->toDateTimeString();
        $order->discount = $request->discount;
        $order->total_price = $request->grand_total;
        $order->payment = $request->payment;
        $order->updated_by = Auth::id();
        $order->save();

    /*  // supplier account data store
        $ca = new SupplierAccount();
        $ca->pay_date = $dt->toDateTimeString();
        $ca->supplier_id =  $request->supplier_name;
        $ca->purchase_id = $order->id;
        $ca->amount = $request->payment;
        $ca->note = $request->note;
        $ca->save();*/
    
        // order details section
        for($i = 0; $i<count($data['product_id']); $i++ ){
                $list = OrderDetail::find($data['order_detail_id'][$i]);
                $list->user_id = Auth::id();
                $list->quantity = $data['ordered_quantity'][$i];
                $list->order_date =  $dt->toDateTimeString();
                $list->save();
            }

            return redirect()->route('admin.order.index')->with('success','Order List Information Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->back()->with('success','Order List Delete Success');
    }
}
