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
use App\Model\Type;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\PurchaseDetail;
use App\Model\Account;
use App\Model\About;
use DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show = $request->show;
        if($show != ''){
            $sales = Sale::latest()->paginate($show);
        }
        else{
            $sales = Sale::latest()->paginate(10);
        }
        return view('backend.admin.sale.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Sale::latest('id')->first();
        if($invoices != ''){
            $inv_no = date('dmy').$invoices->id + 1; 
        }
        else{
            $inv_no = date('dmy').'1';
        }
       // $districs = Distric::orderby('distric_name','ASC')->get();
        $types = Type::orderBy('type_name','ASC')->get();
       // $customers = Customer::orderBy('customer_name','ASC')->get();
        //$customers = Customer::all('id','customer_name','distric_id','upozila_id');
        return view('backend.admin.sale.create',compact('types','inv_no'));
    }
    /*----------Customer Details Section------------------*/
    public function customerList(){
        $customer = Customer::with('distric')->orderBy('customer_name','ASC')->get();
        $data = [];
        foreach($customer as $cus){
            $data[] = $cus->customer_name.', '.$cus->customer_phone;
        }
        return response()->json($data);
    }
    public function customerDetails(Request $request){
        $customer = $request->customer;
        /**
         * explode customer name and phone then search the customer for detail information
         */
        $value  = explode(',',$customer); 
        $name = $value[0];
        $phone = isset($value[1]) ? $value[1] : null;
       // return response()->json($phone);
        if($name != '' && $phone != ''){
            $data = Customer::where('customer_name',trim($name))->where('customer_phone',trim($phone))->firstOrFail();
        }
        else{
            $data = '';
        }
        
        return response()->json($data);
    }
    /*
    * Get Customer Suggestion Liist
    *
    */

    public function productList2(Request $request)
    {
        $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->select('purchase_stocks.*','products.product_name')
                        ->where('purchase_stocks.type_id',$request->type)
                        ->get(); 
        return response()->json($products);
    }
    public function productDetails2(Request $request)
    {
           //$test = Product::with('category','brand','unit')->find($request->id);
           $products  = DB::table('purchase_stocks')
                        ->join('products', 'purchase_stocks.product_id', '=', 'products.id')
                        ->join('categories', 'purchase_stocks.category_id', '=', 'categories.id')
                        ->join('brands', 'purchase_stocks.brand_id', '=', 'brands.id')
                        ->join('units', 'purchase_stocks.unit_id', '=', 'units.id')
                        ->select('purchase_stocks.*','products.product_name', 'categories.category_name', 'brands.brand_name','units.unit_name')
                        ->where('purchase_stocks.id',$request->id)
                        ->first();
        return response()->json($products);
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
            // return $request->all();
            $this->validate($request,[
                'customer_name'=>'required',
               // 'payment'=>'required',
                'sale_date'=>'required',
            ]);
    
            $data = $request->except('_token','submit');

            $dt = Carbon::parse($request->sale_date);
            $date = $dt->toDateTimeString();
            $sale = new Sale();
            $sale->user_id = Auth::id();
            $dt = Carbon::parse($request->sale_date);
            $sale->sale_date = $dt->toDateTimeString();
        if($request->customer_id == ''){

                $customer = new Customer();
                $customer->customer_name = $request->customer_name;
                $customer->customer_phone = $request->customer_phone;
                $customer->save();

                $sale->customer_id = $customer->id;  
            }
        else{
                $sale->customer_id = $request->customer_id;
            }

            $sale->total_price = $request->total_price;
            $sale->invoice_no = $request->invoice_no;
            $sale->discount = $request->discount;
        // $sale->shiping_cost = $request->shiping_cost;
            $sale->grand_total_price = $request->grand_total;
            $sale->payment = $request->payment;
            //$sale->payment_by = $request->payment_by;
        if($request->grand_total >= $request->payment)
            {
                $sale->payment_status = 'Due';
            }
            else{
                $sale->payment_status = 'Paid';
            }
            $sale->due_amount = $request->due;
            $sale->payment_by = $request->payment_by;
            if($request->payment_by != 'Cash'){
                $sale->transaction_no = $request->transaction_no;
            }
            $sale->note = $request->note;
            $sale->save();

            $ca = new CustomerAccount();
            $ca->ca_date = $dt->toDateTimeString();
            $ca->customer_id = $sale->customer_id;
            $ca->sale_id = $sale->id;
            $ca->amount = $request->payment;
            $ca->note = $request->note;
            $ca->save();

            
        /*   $details ='';
            $profit = 0;*/
            for($i = 0; $i<count($data['purchase_details_id']); $i++ )
            {
                $detail = new SaleDetail();
                $detail->sale_id = $sale->id;
                $detail->customer_id = $sale->customer_id;
                $detail->purchase_detail_id = $data['purchase_details_id'][$i];

                // search purchase details 
                $pur = PurchaseDetail::find($data['purchase_details_id'][$i]);

                $detail->warehouse_id = $pur->warehouse_id;
                $detail->product_id = $pur->product_id;
                $detail->category_id = $pur->category_id;
                $detail->brand_id = $pur->brand_id;
                $detail->type_id = $pur->type_id;
                $detail->caret_id = $pur->caret_id;
                $detail->unit_id = $pur->unit_id;
                $detail->rack_no = $pur->rack_no;
                $detail->weight = $pur->weight;
                

                
                $detail->quantity = $data['ordered_quantity'][$i];
                
                $detail->unit_price = $data['sale_price'][$i];
                $detail->discount = $data['single_discount'][$i];

                $dt2 = Carbon::parse($request->sale_date);
                $data['sale_date'] = $dt2->toDateTimeString();
                $detail->sale_date = $data['sale_date'];

                $detail->save();
                /* for decrement stock quantity*/
                DB::table('purchase_details')
                    ->where('id', '=', $data['purchase_details_id'][$i])
                    ->decrement('now_stock', $data['ordered_quantity'][$i]);

            };

        /* DB::commit(); 
        }
        catch (\Exception $e) 
                {
                    DB::rollback();
                    // something went wrong
                    return redirect()->back()->with('warning','Woops! Product Sale Fail');
                }*/
        //  echo"<script>var con = confirm('Do you want to print invoice'); </script>";
            //$abc = "<script>document.write(con)</script>";
        // return $abc;
        /* if($abc == true){
                return view('backend.admin.sale.print',compact('sale'));
            }
            else{
                return redirect()->back()->with('success','Sale Information Save Successfull');
            }*/

         return view('backend.admin.sale.after_save_print',compact('sale'));
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
        $sale = Sale::find($id);
        return view('backend.admin.sale.show',compact('sale'));
    }
    /**
     * customer purchase section
     */
    public function customerPurchase($id)
    {
        $sales = Sale::where('customer_id',$id)->paginate(10);
        return view('backend.admin.sale.index',compact('sales'));
    }
    /**
     * Print Section
     */
    public function salePrint($id){
        $sale = Sale::find($id);
        return view('backend.admin.sale.print',compact('sale'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('backend.admin.sale.edit',compact('sale'));
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
        $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d'))->exists();

        if($closing != true){
                $this->validate($request,[
                    'payment'=>'required',
                    'sale_date'=>'required',
                ]);
    
            $data = $request->except('_token','submit');
            
            $dt = Carbon::parse($request->sale_date);
            
            $sale =  Sale::find($id);
            $sale->customer_id = $request->customer_id;
            $sale->user_id = Auth::id();
            $dt = Carbon::parse($request->sale_date);
            $sale->sale_date = $dt->toDateTimeString();
            $sale->total_price = $request->total_price;
            //$sale->invoice_no = $request->invoice_no;
            $sale->discount = $request->discount;
            $sale->grand_total_price = $request->grand_total;
            $sale->payment = $request->payment;
        if($request->grand_total >= $request->payment)
            {
                $sale->payment_status = 'Due';
            }
            else{
                $sale->payment_status = 'Paid';
            }
            $sale->due_amount = $request->due;
            $sale->note = $request->note;
            

            $ca =  CustomerAccount::where('ca_date',$sale->sale_date)->where('customer_id',$request->customer_id)->where('sale_id',$id)->where('amount',$sale->payment)->first();
            if(!empty($ca)) {    
                $ca->ca_date = $dt->toDateTimeString();
                $ca->amount = $request->payment;
                $ca->note = $request->note;
                $ca->save();
            }else{
                $ca = new CustomerAccount();
                $ca->ca_date = $dt->toDateTimeString();
                $ca->customer_id = $request->customer_id;
                $ca->sale_id = $sale->id;
                $ca->amount = $request->payment;
                $ca->note = $request->note;
                $ca->save();
            }
        /*-------------------*/
        $sale->save();
        /*------------------------*/   
            for($i = 0; $i<count($data['purchase_detail_id']); $i++ )
            {
                $detail =  SaleDetail::find($data['sale_detail_id'][$i]);
                $detail->customer_id = $request->customer_id;
                $detail->purchase_detail_id = $data['purchase_detail_id'][$i];
                $dt2 = Carbon::parse($request->sale_date);
                $data['sale_date'] = $dt2->toDateTimeString();
                $detail->sale_date = $data['sale_date'];
                $detail->quantity = $data['ordered_quantity'][$i];
                $detail->unit_price = $data['sale_price'][$i];
                $detail->discount = $data['single_discount'][$i];
                /*--------first add sold stock------------*/
                DB::table('purchase_details')->where('id', '=', $data['purchase_detail_id'][$i])->increment('now_stock', $detail->quantity);

                $detail->save();
                /* then decrement stock quantity*/
                DB::table('purchase_details')->where('id', '=', $data['purchase_detail_id'][$i])->decrement('now_stock', $data['ordered_quantity'][$i]);

            };
            return redirect()->route('admin.sale.index')->with('success','Sale Information Update Success'); 
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
        $sale = Sale::find($id);
        $details = SaleDetail::where('sale_id',$sale->id)->get();
		foreach($details as $detail)
		{	
			$purchase = PurchaseDetail::find($detail->purchase_detail_id);
			$stock = $purchase->now_stock + $detail->quantity;
			$purchase->now_stock = $stock;
			$purchase->save();	
		}
		//dd($stock);
        $sale->delete();

        return redirect()->back()->with('success','Sale List Delete Success');
    }
}
