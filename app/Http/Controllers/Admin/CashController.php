<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Model\Income;
use App\Model\Incometype;
use App\Model\Expense;
use App\Model\Expensetype;
use App\Model\About;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\PurchaseReturn;
use App\Model\PurchaseDetail;
use App\Model\PurchaseReturnDetail;
use App\Model\Supplier;
use App\Model\SupplierAccount;
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\SaleReturn;
use App\Model\SaleReturnDetail;
use App\Model\Customer;
use App\Model\CustomerAccount;
use App\Model\WastageReturn;
use App\Model\Loan;
use App\Model\BankTransaction;
use App\Model\CashClosing;
use DB;

class CashController extends Controller
{
    /*--------cash closing index section----------------*/
    public function closing_index(Request $r){

        if($r->status == 'Search'){
           /*--------receipt from client-----------*/
           $closing_date =  date('Y-m-d',strtotime($r->closing_date));

           $cus_pay = CustomerAccount::whereDate('ca_date', $closing_date)->sum('amount');
           $lo_receive = Loan::whereDate('transaction_date',$closing_date)->sum('credit');
           $bank_wit = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Withdraw')->sum('transaction_amount');
           /*------payment from clients------------*/
           $sup_pay = SupplierAccount::whereDate('pay_date', $closing_date)->sum('amount');
           $lo_pay = Loan::whereDate('transaction_date',$closing_date)->sum('debit');
           $expense = Expense::whereDate('expense_date',$closing_date)->sum('expense_amount');
           $bank_depo = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Deposit')->sum('transaction_amount');
        }else{
            /*--------receipt -----------*/
            $closing_date =  date('Y-m-d');
            $cus_pay = CustomerAccount::whereDate('ca_date', $closing_date)->sum('amount');
            $lo_receive = Loan::whereDate('transaction_date',$closing_date)->sum('credit');
            $bank_wit = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Withdraw')->sum('transaction_amount');
            /*------payment ------------*/
            $sup_pay = SupplierAccount::whereDate('pay_date', $closing_date)->sum('amount');
            $lo_pay = Loan::whereDate('transaction_date',$closing_date)->sum('debit');
            $expense = Expense::whereDate('expense_date',$closing_date)->sum('expense_amount');
            $bank_depo = BankTransaction::whereDate('transaction_date',$closing_date)->where('transaction_status','Deposit')->sum('transaction_amount');
        }   
            $receipt = $cus_pay + $lo_receive + $bank_wit;
            $payment = $sup_pay + $lo_pay + $bank_depo + $expense;
            /*-----lastday cash-----------*/
            $lastday_cash = CashClosing::whereDate('closing_date', '<=', $closing_date)->latest('closing_date')->first();
            
            return view('backend.admin.cash.closing_index',compact('receipt','payment','lastday_cash','closing_date'));
        
    }
    public function closing_save(Request $r){
        /*-------------------------------Check ---------the existing item-----------------*/
       $closing_date =  date('Y-m-d',strtotime($r->closing_date));
        $closing =  DB::table('cash_closings')->whereDate('closing_date',$closing_date)->exists();
        if($closing == false){
            $cash = new CashClosing();
            $cash->closing_date = $closing_date;
            $cash->lastday_balance = $r->lastday_balance;
            $cash->receipt = $r->receipt;
            $cash->payment = $r->payment;
            $cash->balance = $r->current_balance;
            $cash->save();

            return redirect()->route('admin.cash.closing_index')->with('success','Cash Closing Save Success');
        }else{
            return redirect()->back()->with('error','Woops! this day`s cash has been closed');
        }
    }
    /**---------closing ledger---------- */
    public function closing_ledger(){
        $from_date =  date('Y-m-01') ;
        $to_date = date('Y-m-d');

        $cashs = CashClosing::whereDate('closing_date', '>=', $from_date)
                            ->whereDate('closing_date', '<=', $to_date)
                            ->get();
        return view('backend.admin.cash.closing_ledger',compact('cashs','from_date','to_date'));
    }
    /*-----------closing search-----------------*/
    public function closing_search(Request $r){
        $from_date =  date('Y-m-d',strtotime($r->from_date));
        $to_date =  date('Y-m-d',strtotime($r->to_date)) ;
        $cashs = CashClosing::whereDate('closing_date', '>=', $from_date)
                            ->whereDate('closing_date', '<=', $to_date)
                            ->get();
        return view('backend.admin.cash.closing_ledger',compact('cashs','from_date','to_date'));
    }
}
