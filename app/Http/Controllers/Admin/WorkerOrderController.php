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
use App\Model\OrderDetail;
use App\Model\WorkerOrder;
use App\Model\WorkerOrderDetail;
use App\Model\Worker;
use App\Model\WorkerAccount;
use DB;

class WorkerOrderController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:worker-order-list');
         $this->middleware('permission:worker-order-entry', ['only' => ['create','store']]);
         $this->middleware('permission:worker-order-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:worker-order-delete', ['only' => ['destroy']]);
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
            $orders = WorkerOrder::where('status','Pending')->latest()->paginate($show);
        }
        else{
            $orders = WorkerOrder::where('status','Pending')->latest()->paginate(setting()->ddspinp);
        }
       
        return view('backend.admin.worker_order.index',compact('orders'));
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
        $invoices = WorkerOrder::latest()->first();
        $workers = Worker::orderBy('name','ASC')->get();
        if($invoices != ''){
            $order_no = date('dmy').$invoices->id + 1; 
        }
        else{
            $order_no = date('dmy').'1';
        }
        return view('backend.admin.worker_order.create',compact('types','order_no','carets','workers'));
    }
    public function productList6(Request $request){
        if($request->order_from == 'customer_order'){
            $test = OrderDetail::with('product')->where('type_id', $request->type)->where('status','Pending')->get();
        }else{
            $test = Product::where('type_id', $request->type)->get();
        }
        return response()->json($test);
    }
    public function productDetails6(Request $request){
        if($request->order_from == 'customer_order'){
            $test = OrderDetail::with('product','category','type','caret')->find($request->id);
        }else{
            $test = Product::with('category','type')->find($request->id);
        }
        
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
       /* $this->validate($request,[
             'order_date'=>'required',
             'delivery_date'=>'required',
             'order_no'=>'required|unique:orders,order_no',
         ]);*/
 
        $data = $request->except('_token','submit');
   // return $data;
        $order = new WorkerOrder();
        $order->worker_id = $request->worker_id;
        $order->user_id = Auth::id();
        $order->caret_id = $request->given_caret;
        $order->order_no = $request->order_no;
        $order->gold_amount = $request->gold_amount;
        $order->per_gram_wage = $request->per_gram_wage;
        $order->total_wage = $request->total_price;
        $order->payment = $request->payment;
        $order->due = $request->due;
        $dt = Carbon::parse($request->order_date);
        $order->order_date =  $dt->toDateTimeString();
        $order->created_by = Auth::id();
        $order->save();
 
         // customer account data store
         $ca = new WorkerAccount();
         $ca->payment_date = $dt->toDateTimeString();
         $ca->worker_id =  $order->worker_id;
         $ca->worker_order_id = $order->id;
         $ca->amount = $request->payment;
        //$ca->note = $request->note;
         $ca->save();
     
         // order details section
         for($i = 0; $i<count($data['product_id']); $i++ ){
 
                $list = new WorkerOrderDetail();
                $list->worker_order_id = $order->id;
                $list->worker_id = $order->worker_id;
                $list->user_id = Auth::id();
                /*---------------------------------------------
                    => ods is order details id 
                    => if order is from customer section
                    => insert data into order detail is field
                *----------------------------------------------*/
                if($data['ods_id'][$i] != 0){
                    $od = OrderDetail::find($data['ods_id'][$i]);

                    $list->order_detail_id =  $data['ods_id'][$i];
                    $list->product_id =  $od->product_id;
                    $list->category_id =  $od->category_id;
                    $list->type_id = $od->type_id;
                    $list->caret_id = $data['caret_id'][$i];
                }else{
                    $product = Product::find($data['product_id'][$i]);

                    $list->product_id =  $data['product_id'][$i];
                    $list->category_id =  $product->category_id;
                    $list->type_id = $product->type_id;
                    $list->caret_id = $data['caret_id'][$i];
                }
                
                $list->order_no = $request->order_no;
                $list->weight = $data['weight'][$i];
                $list->wage = $data['wage'][$i];
                $list->order_date =  $dt->toDateTimeString();
                $list->created_by = Auth::id();
                $list->save();
             }

             return redirect()->route('admin.worker_order.index')->with('success','WorkerOrder Save Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerOrder($id)
    {
        $orders = WorkerOrder::where('customer_id',$id)->paginate(10);
        return view('backend.admin.worker_order.customerOrder',compact('orders'));
    }
    /*------------*/
    public function show($id)
    {
        $order = WorkerOrder::find($id);
        return view('backend.admin.worker_order.show',compact('order'));
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
        $order = WorkerOrder::find($id);

        return view('backend.admin.worker_order.edit',compact('order'));
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
        
        $order =  WorkerOrder::find($id);
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
                $list = WorkerOrderDetail::find($data['order_detail_id'][$i]);
                $list->user_id = Auth::id();
                $list->quantity = $data['ordered_quantity'][$i];
                $list->order_date =  $dt->toDateTimeString();
                $list->save();
            }

            return redirect()->route('admin.order.index')->with('success','WorkerOrder List Information Update Success');
    }
    /*----------=> return sectionm*******--------------*/
    public function return_worker_order(){
        $workers = Worker::where('status','Active')->get();
        $orders = WorkerOrderDetail::where('status','Returned')->paginate(setting()->ddspinp);
        return view('backend.admin.worker_order_return.index',compact('workers','orders'));
    }
    public function getOrderNo(Request $request){
        $dd = WorkerOrder::where('worker_id',$request->id)->where('status','Pending')->get();
        return response()->json($dd);
    }
    public function worker_order_search(Request $request){
        $pd = WorkerOrder::find($request->order_id);
        return view('backend.admin.worker_order_return.create',compact('pd'));
    }
    public function worker_order_store(Request $request){

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = WorkerOrder::find($id);
        $order->delete();

        return redirect()->back()->with('success','WorkerOrder List Delete Success');
    }
}
