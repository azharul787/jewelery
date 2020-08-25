<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\Sale;
use App\Model\Distric;
use App\Model\SaleDetail;
use DB;

class CustomerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:customer-list');
         $this->middleware('permission:customer-entry', ['only' => ['create','store']]);
         $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
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
         $customers = Customer::latest()->paginate($show);
        }
    else{
        $customers = Customer::latest()->paginate(10);
    }
        
        return view('backend.admin.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districs = Distric::orderBY('distric_name','ASC')->get();
        return view('backend.admin.customer.create',compact('customers','districs'));
    }
    /*-----customer list for ledger section-----*/
    public function customerList2(){
        $customer = Customer::orderBy('customer_name','ASC')->get();
    
        return response()->json($customer);
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
            'customer_name'=>'required',
            'customer_phone'=>'required',
            'customer_address'=>'required',
        ]);

        $customer = new Customer();
        $customer->distric_id = $request->distric_name;
        $customer->upozila_id = $request->upozila_name;
        $customer->union_id = $request->union_name;
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_address = $request->customer_address;
        $customer->save();

        return redirect()->route('admin.sale.create')->with('success','Customer Information Save Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $sale = Sale::where(['customer_id'=>$id])->get();
        $account = CustomerAccount::where('customer_id', $id)->get();
        $due = Sale::where('customer_id',$id)->where('due_amount', '>',0)->get();
        $sale_detail = SaleDetail::where('customer_id',$id)->get();
        return view('backend.customer.show',compact('customer','sale','account','due','sale_detail'));
    }
    /**
     * Date wise Customer Purchase Search
     * 
     */
    public function purchaseHistory(Request $request)
    {
        $id = $request->customer_id;
        $from_date = date_create($request->from_date);
        $to_date = date_create($request->to_date);

        $customer = Customer::find($id);
        //$sale = Sale::where('customer_id',$id)->whereDate('sale_date','>=', $from_date)->whereDate('sale_date','<=', $to_date)->get();
        $sale_detail = SaleDetail::where('customer_id',$id)->whereDate('sale_date','>=', $from_date)->whereDate('sale_date','<=', $to_date)->get();
        $account = CustomerAccount::where('customer_id', $id)->get();
        $due = Sale::where('customer_id',$id)->where('due_amount', '>',0)->get();
        return view('backend.customer.show',compact('sale_detail','customer','account','due'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        //$customers = Customer::latest()->paginate(10);
        $districs = Distric::orderBy('distric_name','ASC')->get();
        return view('backend.admin.customer.edit',compact('customer','districs'));
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
        'customer_name'=>'required',
        'customer_phone'=>'required',
        'customer_address'=>'required',
    ]);
      
        $customer = Customer::find($id);
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_email = $request->customer_email;
        $customer->customer_address = $request->customer_address;
        $customer->save();

        return redirect()->route('admin.customer.index')->with('success','Customer Information Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$customer = Customer::find($id);
        if (Storage::disk('public')->exists('customer/'.$customer->image))
        {
            Storage::disk('public')->delete('customer/'.$customer->image);
        }
        $customer->delete();
        return redirect()->back()->with('success','Customer Information Successfully Deleted ');
    }
}
