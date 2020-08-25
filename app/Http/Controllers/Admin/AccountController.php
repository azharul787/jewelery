<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\SupplierAccount;
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\PurchaseDetail;
use App\Model\SaleReturnDetail;
use App\Model\PurchaseReturnDetail;
use App\Model\Expensetype;
use App\Model\Expense;
use App\Model\About;
use App\Model\Loan;
use App\Model\BankTransaction;
use App\Model\CashClosing;
use DB;

class AccountController extends Controller
{
    public function spi(Request $request){
        /*---------delete 0 amount---------------*/
        SupplierAccount::where('amount',0)->delete();

        $show = $request->show;
        if($show != ''){
            $payments = SupplierAccount::latest()->paginate($show);

        }else{
            $payments = SupplierAccount::latest()->paginate(10);
        }
        /*--------------search which supplier who have due amount------------------------*/
       // $suppliers = Supplier::orderBy('supplier_name','ASC')->get();
       $suppliers = DB::select("SELECT s.id, s.supplier_name, sum(p.due_amount) as total_due FROM suppliers s, purchases p WHERE s.id = p.supplier_id AND p.due_amount > 0 GROUP by p.supplier_id ORDER BY p.due_amount DESC ");
        return view('backend.admin.supplier_payment.index',compact('payments','suppliers'));
    }
    public function spsearch(Request $request){
       // return $request->all();
        $validate = request()->validate( [
            'supplier_name'=>'required',
           // 'phone'=>'required',
        ]);
        $pd = Supplier::where('id',$request->supplier_name)->first();
        
        if($pd != NULL){
            
            $purchases = Purchase::where('supplier_id',$pd->id)->get();
            //return $purchases;
            $suppliers = DB::select("SELECT s.id, s.supplier_name, sum(p.due_amount) as total_due FROM suppliers s, purchases p WHERE s.id = p.supplier_id AND p.due_amount > 0 GROUP by p.supplier_id ORDER BY p.due_amount DESC ");
            return view('backend.admin.supplier_payment.create',compact('pd','purchases','suppliers'));
        }
        else{
            return redirect()->back()->with('error','Woops! No Information Found, Please Check the Supplier Name Or Phone No ');
        }
    }
    public function spstore(Request $request){
        $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d',strtotime($request->pay_date)))->exists();

        if($closing != true){
            //return $request->all();
            $supplier_id = $request->supplier_id;
            $amount = $request->amount;
            $pay_date = $request->pay_date;
        /*----------check current balance--------*/
           $closing_date =  date('Y-m-d',strtotime($request->pay_date));

           $cus_pay = CustomerAccount::whereDate('ca_date', $closing_date)->sum('amount');
           $lo_receive = Loan::whereDate('transaction_date',$closing_date)->sum('credit');
           $bank_wit = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Withdraw')->sum('transaction_amount');
           /*------payment from clients------------*/
           $sup_pay = SupplierAccount::whereDate('pay_date', $closing_date)->sum('amount');
           $lo_pay = Loan::whereDate('transaction_date',$closing_date)->sum('debit');
           $expense = Expense::whereDate('expense_date',$closing_date)->sum('expense_amount');
           $bank_depo = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Deposit')->sum('transaction_amount');

           /*-----lastday cash-----------*/
            $lastday_cash = CashClosing::whereDate('closing_date', '<=', $closing_date)->latest('closing_date')->first();

           $receipt = $cus_pay + $lo_receive + $bank_wit;
           $payment = $sup_pay + $lo_pay + $bank_depo + $expense;
           $balance = $lastday_cash->balance + $receipt - $payment;
           /*-----lastday cash-----------*/

        if($balance > $request->payment){
            $pays  = Purchase::where(['supplier_id'=>$supplier_id])->where('due_amount', '>',0)->get();
                foreach($pays  as $pay)
                {
                    if($amount >= $pay->due_amount && $amount >= 0)
                    {
                        $x = $amount - $pay->due_amount;
                        $need_amount = $amount - $x;
                        $pay->payment = $pay->payment + $need_amount;
                        $pay->due_amount = $pay->due_amount - $need_amount;
                        if($pay->payment >= $pay->net_purchase_price)
                            {
                                $pay->payment_status = 'Paid';
                            }
                            else{
                                $pay->payment_status = 'Due';
                            }
                        $pay->save();
                        $amount = $x;
                        
                        //for customer account
                        $c_ac = new SupplierAccount();
                        $dt = Carbon::parse($pay_date);
                        $c_ac->pay_date = $dt->toDateTimeString();
                        $c_ac->supplier_id = $request->supplier_id;
                        $c_ac->purchase_id =  $pay->id;
                        $c_ac->amount =  $need_amount;
                        $c_ac->note = $request->note;
                        $c_ac->save();
                        //DB::commit();
                    }
                    else
                    {
                        $pay->payment = $pay->payment + $amount;
                        $pay->due_amount = $pay->due_amount - $amount;
                        $pay->save();	
                        
                        //for customer account
                        $c_ac = new SupplierAccount();
                        $dt = Carbon::parse($pay_date);
                        $c_ac->pay_date = $dt->toDateTimeString();
                        $c_ac->supplier_id = $request->supplier_id;
                        $c_ac->purchase_id =  $pay->id;
                        $c_ac->amount =  $amount;
                        $c_ac->note = $request->note;
                        $c_ac->save();
                        $amount = 0;
                    //	DB::commit();
                    }
                }
  
                return redirect()->route('admin.account.spi')->with('success','Due payment successfull');
            }else{
                return redirect()->route('admin.account.spi')->with('error','Woops! Current Balance is not enough Please check curent baance ');
            }
        }
        else{
            return redirect()->route('admin.account.spi')->with('error','Woops! After Cash Closing Transaction will not be possible ');
        }
    }
    /**
     * => customer payment section
     */
    public function cpi(Request $request){
        /*---------delete 0 amount---------------*/
        CustomerAccount::where('amount',0)->delete();

        $show = $request->show;
        if($show != ''){
            $payments = CustomerAccount::latest()->paginate($show);

        }else{
            $payments = CustomerAccount::latest()->paginate(10);
        }
        /*--------------search which supplier who have due amount------------------------*/
       // $suppliers = Supplier::orderBy('supplier_name','ASC')->get();
       $customers = DB::select("SELECT c.id, c.customer_name, sum(s.due_amount) as total_due 
                                    FROM customers c, sales s
                                    WHERE c.id = s.customer_id 
                                    AND s.due_amount > 0 
                                    GROUP by s.customer_id 
                                    ORDER BY s.due_amount DESC ");
        return view('backend.admin.customer_payment.index',compact('payments','customers'));
    }
    public function cpsearch(Request $request){
       // return $request->all();
        $validate = request()->validate( [
            'customer_name'=>'required',
           // 'phone'=>'required',
        ]);
        $cs = Customer::where('id',$request->customer_name)->first();
        $types = Expensetype::all();

        if($cs != NULL){
            
            $sales = Sale::where('customer_id',$cs->id)->where('due_amount', '>',0)->get();
            //return $purchases;
            $customers = DB::select("SELECT c.id, c.customer_name, sum(s.due_amount) as total_due FROM customers c, sales s WHERE c.id = s.customer_id AND s.due_amount > 0 GROUP by s.customer_id ORDER BY s.due_amount DESC ");
            return view('backend.admin.customer_payment.create',compact('cs','sales','customers','types'));
        }
        else{
            return redirect()->back()->with('error','Woops! No Information Found, Please Check the Supplier Name Or Phone No ');
        }
    }
    public function cpstore(Request $request){
        $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d',strtotime($request->pay_date)))->exists();

        if($closing != true){
            //return $request->all();
            $customer_id = $request->customer_id;
            $amount = $request->total_payment;
            $pay_date = $request->pay_date;
        /* try
            {	
                DB::beginTransaction();*/
            $pays  = Sale::where(['customer_id'=>$customer_id])->where('due_amount', '>',0)->get();
                foreach($pays  as $pay)
                {
                    if($amount >= $pay->due_amount && $amount >= 0)
                    {
                        $x = $amount - $pay->due_amount;
                        $need_amount = $amount - $x;
                        $pay->payment = $pay->payment + $need_amount;
                        $pay->due_amount = $pay->due_amount - $need_amount;
                        if($pay->payment >= $pay->net_purchase_price)
                            {
                                $pay->payment_status = 'Paid';
                            }
                            else{
                                $pay->payment_status = 'Due';
                            }
                        $pay->save();
                        $amount = $x;
                        
                        //for customer account
                        $c_ac = new CustomerAccount();
                        $dt = Carbon::parse($pay_date);
                        $c_ac->ca_date = $dt->toDateTimeString();
                        $c_ac->customer_id = $request->customer_id;
                        $c_ac->sale_id =  $pay->id;
                        $c_ac->amount =  $need_amount;
                        $c_ac->note = $request->note;
                        $c_ac->save();
                        //DB::commit();
                    }
                    else
                    {
                        $pay->payment = $pay->payment + $amount;
                        $pay->due_amount = $pay->due_amount - $amount;
                        $pay->save();	
                        
                        //for customer account
                        $c_ac = new CustomerAccount();
                        $dt = Carbon::parse($pay_date);
                        $c_ac->ca_date = $dt->toDateTimeString();
                        $c_ac->customer_id = $request->customer_id;
                        $c_ac->sale_id =  $pay->id;
                        $c_ac->amount =  $amount;
                        $c_ac->note = $request->note;
                        $c_ac->save();
                        $amount = 0;
                    //	DB::commit();
                    }
                }
                /*-----------discount data insert into expense table-------------------*/
                if($request->discount != ''){

                    $ex = new Expense();
                    $ex->expensetype_id = $request->type_name;
                    $ex->user_id = Auth::id();
                    $dt = Carbon::parse($pay_date);
                    $ex->expense_date = $dt->toDateTimeString();
                    $ex->expense_amount = $request->discount;
                    $ex->description = $request->note;
                    $ex->save();
                }
        /* }
            catch (\Exception $e) 
            {
                DB::rollback();
                // something went wrong
                return redirect()->route('admin.account.spi')->with('warning','Woops! Something went wrong');
            }*/
        return redirect()->route('admin.account.cpi')->with('success','Due payment successfull');
        }
        else{
            return redirect()->back()->with('error','Woops! After cash closing all transaction has been stoped');
        }
    }
}
