<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\Bank;
use App\Model\BankTransaction;
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
use App\Model\Product;
use App\Model\About;
use DB;


class LedgerController extends Controller
{
    /**
    * Role and permission implement by ****** 
    * >>>>>> Md Azharul Islam
    * >>>>>> azharul787@gmail.com
    *>>>>>>> Software Developer
    */
    function __construct()
    {
        $this->middleware('permission:customer-ledger', ['only' => ['cledgeri','cledgers']]);
        $this->middleware('permission:supplier-ledger',['only'=>['sledgeri','sledgers']]);
        $this->middleware('permission:bank-balance',['only'=>['bankbalance']]);
        $this->middleware('permission:profit-balance',['only'=>['ipri','iprs','ppri','pprs']]);
        $this->middleware('permission:income-expense', ['only' => ['income_expense','income_expenses']]);
        $this->middleware('permission:daily-summary', ['only' => ['daily_summary']]);

    }
    /*--------------customer ledger index section---------------*/
    public function cledgeri(){
        $transactions = '';
        return view('backend.admin.ledger.customer_ledger',compact('transactions'));
    }
    /*--------------customer ledger search section---------------*/
    public function cledgers(Request $request){
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date)) ;
        $customer_id = $request->customer_id; 

        
        $customer = Customer::find($customer_id);
        $transactions = CustomerAccount::where('customer_id',$customer_id)
                                        ->whereDate('ca_date', '>=', $from_date)
                                        ->whereDate('ca_date', '<=', $to_date)
                                        ->where('amount', '>',0)
                                        ->get();

        return view('backend.admin.ledger.customer_ledger',compact('customer','transactions','from_date','to_date')); 
    }
     /*--------------Supplier ledger index section---------------*/
    public function sledgeri(){
        $transactions = '';
        return view('backend.admin.ledger.supplier_ledger',compact('transactions'));
    }
    /*-------------- Supplier ledger search section---------------*/
    public function sledgers(Request $request){
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date)) ;
        $supplier_id = $request->supplier_id; 

        
        $supplier = Supplier::find($supplier_id);
        $transactions = SupplierAccount::where('supplier_id',$supplier_id)
                                        ->whereDate('pay_date', '>=', $from_date)
                                        ->whereDate('pay_date', '<=', $to_date)
                                        ->where('amount', '>',0)
                                        ->get();

        return view('backend.admin.ledger.supplier_ledger',compact('supplier','transactions','from_date','to_date')); 
    }
    
    /*-----------total bank balance section-------------------*/
    public function bankbalance(Request $request){
        
        $cbalances = DB::select("SELECT b.*, tr.bank_id, 
                            SUM(IF(tr.transaction_status = 'Deposit', tr.transaction_amount, 0)) AS total_deposit,
                            SUM(IF(tr.transaction_status = 'Withdraw', tr.transaction_amount, 0)) AS total_withdraw 
                        FROM banks b, bank_transactions tr
                        WHERE tr.bank_id = b.id
                        GROUP BY tr.bank_id
                    ");
        return view('backend.admin.ledger.bank_balance',compact('cbalances'));

    }
    /*-------------Invoice wise profit report-----------------*/
    public function ipri(){
        $invoices = DB::select("SELECT DISTINCT sales.id, sales.invoice_no FROM `sales` ");
        
        $from_date =  date('Y-m-01') ;
        $to_date = date('Y-m-d');
        $ty = 'All' ;

        $sales = Sale::whereDate('sale_date', '>=', $from_date)
                          ->whereDate('sale_date', '<=', $to_date)
                          ->get();
          
        return view('backend.admin.ledger.profit.invoice_report',compact('invoices','sales','ty','from_date','to_date'));
        
    }
    /*--------------------Invoice wise profit resport search-------------------------*/
    public function iprs(Request $request){
        $invoices = DB::select("SELECT DISTINCT sales.id, sales.invoice_no FROM `sales` ");

        $from_date =  date('Y-m-d',strtotime($request->from_date)) ;
        $to_date =  date('Y-m-d',strtotime($request->to_date)) ;

        if($request->invoice_no === "All"){
            $ty = $request->invoice_no ;
              $sales = Sale::whereDate('sale_date', '>=', $from_date)
                          ->whereDate('sale_date', '<=', $to_date)
                          ->get();
           }
           else{
               $ty =  $request->invoice_no;

              $sales = Sale::where('invoice_no',$request->invoice_no)
                         // ->whereDate('sale_date', '>=', $from_date)
                        //  ->whereDate('sale_date', '<=', $to_date)
                          ->get();
              }
        return view('backend.admin.ledger.profit.invoice_report',compact('invoices','sales','ty','from_date','to_date'));
        
    }

    /*-------------product wise profit report-----------------*/
    public function ppri(){
        $products = DB::select("SELECT DISTINCT sale_details.product_id, products.product_name,products.model_no FROM products,`sale_details` WHERE products.id = sale_details.product_id ");
        $from_date =  date('Y-m-01') ;
        $to_date = date('Y-m-d');
        $ty = 'All' ;

        $sales = SaleDetail::whereDate('sale_date', '>=', $from_date)
                          ->whereDate('sale_date', '<=', $to_date)
                          ->get();
          
        return view('backend.admin.ledger.profit.product_report',compact('products','sales','ty','from_date','to_date'));

    }
    /*--------------------product wise profit resport search-------------------------*/
    public function pprs(Request $request){
        $products = DB::select("SELECT DISTINCT sale_details.product_id, products.product_name,products.model_no FROM products,`sale_details` WHERE products.id = sale_details.product_id ");
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));

        if($request->product_id === "All"){
            $ty = $request->product_id ;
              $sales = SaleDetail::whereDate('sale_date', '>=', $from_date)
                          ->whereDate('sale_date', '<=', $to_date)
                          ->get();
           }
           else{
               $pro = Product::find($request->product_id);
               $ty =  $pro->product_name;

              $sales = SaleDetail::where('product_id',$request->product_id)
                          ->whereDate('sale_date', '>=', $from_date)
                          ->whereDate('sale_date', '<=', $to_date)
                          ->get();
              }
        return view('backend.admin.ledger.profit.product_report',compact('products','sales','ty','from_date','to_date'));
    }
    /*---------------income expense report section----------------*/
    public function income_expense(){
        $today = date('Y-m-d');
        $from =  date('Y-m-d');
        $to = date('Y-m-d');
        $user_id = Auth::id();

        DB::insert("DELETE FROM income_expenses WHERE user_id = $user_id;
                    INSERT INTO income_expenses( user_id, transaction_date, description, income_amount ) SELECT $user_id, ca.ca_date, c.customer_name, ca.amount FROM customer_accounts AS ca, customers AS c WHERE c.id = ca.customer_id AND ca.ca_date = $today AND ca.amount != '0.00';
                    INSERT INTO income_expenses( user_id, transaction_date, description, expense_amount ) SELECT $user_id,  e.expense_date, t.type_name, e.expense_amount FROM expenses as e, expensetypes as t WHERE t.id = e.expensetype_id AND e.expense_date = $today;
                    INSERT INTO income_expenses( user_id, transaction_date, description, expense_amount ) SELECT $user_id, sa.pay_date, s.supplier_name, sa.amount FROM suppliers AS s, supplier_accounts AS sa WHERE s.id = sa.supplier_id AND sa.pay_date = $today AND sa.amount != '0.00'; 
                    INSERT INTO income_expenses( user_id, transaction_date, description, expense_amount ) SELECT $user_id, lo.transaction_date, ln.loaner_name, lo.debit FROM loaners as ln, loans as lo WHERE ln.id = lo.loaner_id AND lo.transaction_date = $today AND debit != '0.00' ; 
                    INSERT INTO income_expenses( user_id, transaction_date, description, income_amount ) SELECT $user_id, lo.transaction_date, ln.loaner_name, lo.credit FROM loaners as ln, loans as lo WHERE ln.id = lo.loaner_id AND lo.transaction_date = $today AND credit != '0.00' ; 
                    ");
        $data = DB::select("SELECT * FROM income_expenses WHERE user_id = $user_id");

        return view('backend.admin.ledger.income_expense',compact('data','from','to'));
    }
    public function income_expenses(Request $request){
        $from =  date('Y-m-d',strtotime($request->from_date));
        $to =  date('Y-m-d',strtotime($request->to_date));

        $user_id = Auth::id();

        DB::insert("DELETE FROM income_expenses WHERE user_id = $user_id;
                    INSERT INTO income_expenses( user_id, transaction_date, description, income_amount ) SELECT $user_id, ca.ca_date, c.customer_name, ca.amount FROM customer_accounts AS ca, customers AS c WHERE c.id = ca.customer_id AND ca.ca_date >=  '$from'  AND ca.ca_date <= '$to' AND ca.amount != '0.00';
                    INSERT INTO income_expenses( user_id, transaction_date, description, expense_amount ) SELECT $user_id,  e.expense_date, t.type_name, e.expense_amount FROM expenses as e, expensetypes as t WHERE t.id = e.expensetype_id AND e.expense_date >= '$from' AND e.expense_date <= '$to';
                    INSERT INTO income_expenses( user_id, transaction_date, description, expense_amount ) SELECT $user_id, sa.pay_date, s.supplier_name, sa.amount FROM suppliers AS s, supplier_accounts AS sa WHERE s.id = sa.supplier_id AND sa.pay_date >= '$from' AND sa.pay_date <= '$to' AND sa.amount != '0.00'; 
                    INSERT INTO income_expenses( user_id, transaction_date, description, expense_amount ) SELECT $user_id, lo.transaction_date, ln.loaner_name, lo.debit FROM loaners as ln, loans as lo WHERE ln.id = lo.loaner_id AND lo.transaction_date >= '$from' AND lo.transaction_date <= '$to' AND debit != '0.00' ; 
                    INSERT INTO income_expenses( user_id, transaction_date, description, income_amount ) SELECT $user_id, lo.transaction_date, ln.loaner_name, lo.credit FROM loaners as ln, loans as lo WHERE ln.id = lo.loaner_id AND lo.transaction_date >= '$from' AND lo.transaction_date <= '$to' AND credit != '0.00' ;  
                    ");
        $data = DB::select("SELECT * FROM income_expenses WHERE user_id = $user_id");
       
        return view('backend.admin.ledger.income_expense',compact('data','from','to'));

    }
    /*----------------daily summary-----------------------*/
    public function daily_summary(){
        /*---------delete 0 amount---------------*/
        SupplierAccount::where('amount',0)->delete();
        CustomerAccount::where('amount',0)->delete();
        $today = date('Y-m-d');
        
        $ca =   DB::select("SELECT SUM(ca.amount) AS c_amount, COUNT(ca.amount) AS c_a FROM customer_accounts AS ca WHERE ca.ca_date = $today");
        $sum = array();
        foreach($ca as $sm){
            $sum[] = ['description' => 'Customer Payment', 'transaction' => $sm->c_a, 'income' => $sm->c_amount, 'expense' => 0 ];
        }
        $sa =   DB::select("SELECT SUM(sa.amount) AS s_amount, COUNT(sa.amount) AS s_a FROM supplier_accounts AS sa WHERE sa.pay_date = $today");
        foreach($sa as $s){
            $sum[] = ['description' => 'Supplier Payment', 'transaction' => $s->s_a, 'income' => 0, 'expense' => $s->s_amount ];
        }
        $exp = DB::select("SELECT  SUM(ex.expense_amount) AS ex_amount, count(ex.expense_amount) AS ex_a FROM expenses AS ex WHERE ex.expense_date = $today");
        foreach($exp as $ex){
            $sum[] = ['description' => 'Expense', 'transaction' => $ex->ex_a, 'income' => 0, 'expense' => $ex->ex_amount ];
        }
        $loans =  DB::select("SELECT SUM(lo.debit) AS l_debit, COUNT(lo.id) AS l_d, SUM(lo.credit) AS l_credit FROM loans AS lo WHERE lo.transaction_date = $today");
        foreach($loans as $lo){
            $sum[] = ['description' => 'Loan', 'transaction' => $lo->l_d, 'income' => $lo->l_credit, 'expense' => $lo->l_debit ];
        }
        $banks =  DB::select("SELECT SUM(IF(transaction_status = 'Deposit', transaction_amount, 0)) AS b_debit,  SUM(IF(transaction_status = 'Withdraw', transaction_amount, 0)) AS b_credit ,COUNT(bt.id) AS btc FROM bank_transactions AS bt WHERE bt.transaction_date = $today");
        foreach($banks as $bn){
            $sum[] = ['description' => 'Bank Transaction', 'transaction' => $bn->btc, 'income' => $bn->b_credit, 'expense' => $bn->b_debit ];
        }
        //return $sum;
        return view('backend.admin.ledger.summary',compact('sum'));
    }
    /*----------daily summary details request from ajax-------------*/
    public function summaryDetails(Request $request){
        $today = date('Y-m-d');
        $table = $request->table;
        if($table == 'Customer Payment'){
            $data =   DB::select("SELECT c.customer_name as name,ca.amount AS credit FROM customers c,customer_accounts AS ca WHERE c.id = ca.customer_id and ca.ca_date = $today");
        }
        if($table == 'Supplier Payment'){
            $data =   DB::select("SELECT s.supplier_name as name,sa.amount AS debit FROM suppliers s,supplier_accounts AS sa WHERE s.id = sa.supplier_id and sa.pay_date = $today");
        }
        if($table == 'Expense'){
            $data =   DB::select("SELECT t.type_name as name,ex.expense_amount AS debit FROM expensetypes AS t,expenses AS ex WHERE t.id = ex.expensetype_id and ex.expense_date = $today");
        }
        if($table == 'Loan'){
            $data =   DB::select("SELECT loa.loaner_name as name,lo.debit AS debit, lo.credit as credit FROM loaners as loa, loans as lo  WHERE loa.id = lo.loaner_id and lo.transaction_date = $today");
        }
        if($table == 'Bank Transaction'){
            $data =   DB::select("SELECT b.bank_name as name, IF(bt.transaction_status = 'Deposit', bt.transaction_amount, 0) AS debit, IF(bt.transaction_status = 'Withdraw', bt.transaction_amount, 0) AS credit FROM banks b, bank_transactions bt WHERE b.id = bt.bank_id and bt.transaction_date = $today");
        }
        return response()->json($data);
    }
}
