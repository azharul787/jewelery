<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
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
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\SaleReturn;
use App\Model\SaleReturnDetail;
use App\Model\Customer;
use App\Model\WastageReturn;
use DB;

class ReportController extends Controller
{
    function __construct()
    {
       //  $this->middleware('permission:report-village',['only'=>['ReportVIndex','ReportVSearch']]);
       //  $this->middleware('permission:report-user', ['only' => ['ReportUIndex','ReportUSearch']]);
       //  $this->middleware('permission:report-personal', ['only' => ['personalReport','personalReportSearch']]);
     //    $this->middleware('permission:report-fail', ['only' => ['dueInstallReport','dueInstallReportSearch']]);
        //$this->middleware('permission:report-income', ['only' => ['incomeReportIndex','incomeReportsSearch']]);
        $this->middleware('permission:expense-report', ['only' => ['expenseReportIndex','expenseReportSearch']]);

    }
     
    public function incomeReportIndex(Request $request){
        
        $type = Incometype::orderBy('type_name','ASC')->get();
        $incomes = '';
        return view('backend.admin.report.incomeReportIndex',compact('type','incomes'));
    }
    public function incomeReportSearch(Request $request){
              $from = $request->from_date;
              $to = $request->to_date;
  
            $from_date = date_create($request->from_date);
            $to_date = date_create($request->to_date);

           
            
            $type = Incometype::orderBy('type_name','ASC')->get();
           
            if($request->type_id === "All"){
                $ty = $request->type_id ;
                  $incomes = Income::whereDate('income_date', '>=', $from_date)
                              ->whereDate('income_date', '<=', $to_date)
                              ->get();
               }
               else{
                   $types = Incometype::find($request->type_id);
                   $ty = $types->type_name;
  
                  $incomes = Income::where('incometype_id',$request->type_id)
                              ->whereDate('income_date', '>=', $from_date)
                              ->whereDate('income_date', '<=', $to_date)
                              ->get();
                  }
            return view('backend.admin.report.incomeReportIndex',compact('type','incomes','ty','from','to'));
    }
      /**
       *  Expense report Section
       */
    public function expenseReportIndex(Request $request){
      $from =  date('Y-m-01') ;
      $to = date('Y-m-d');
      $ty = 'All';
      $expensetype = Expensetype::orderBy('type_name','ASC')->get();
      $expenses = Expense::whereDate('expense_date', '>=', $from)
                            ->whereDate('expense_date', '<=', $to)
                            ->get();
      return view('backend.admin.report.expense.expenseReportIndex',compact('expensetype','expenses','from','to','ty'));
    }
    public function expenseReportSearch(Request $request){
            $from = $request->from_date;
            $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

          
          $expensetype = Expensetype::orderBy('type_name','ASC')->get();
          
          if($request->type_id === "All"){
              $ty = $request->type_id ;
                $expenses = Expense::whereDate('expense_date', '>=', $from_date)
                            ->whereDate('expense_date', '<=', $to_date)
                            ->get();
              }
              else{
                  $types = Expensetype::find($request->type_id);
                  $ty = $types->type_name;

                $expenses = Expense::where('expensetype_id',$request->type_id)
                            ->whereDate('expense_date', '>=', $from_date)
                            ->whereDate('expense_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.expense.expenseReportIndex',compact('expensetype','expenses','ty','from','to'));
    }
    /*-
    * =>Chalan wise purchase report
    * cpri => c = chalan, p = purchase, r = report , i = index
    * cprs => c = chalan, p = purchase, r = report , s = search
    */
    public function cpri(Request $request){
         
     
      $chalans = DB::select("SELECT DISTINCT purchases.id, purchases.chalan_no from purchases ");
      $purchases = '';
      return view('backend.admin.report.purchase.chalan_purchase_report_index',compact('chalans','purchases'));
    }
    public function cprs(Request $request){
          $from = $request->from_date;
          $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

          
          /*---------purchase report----------- */
        if($request->report_type == 'Purchase') {
          $chalans = DB::select("SELECT DISTINCT purchases.id, purchases.chalan_no from purchases ");
         
          if($request->chalan_no === "All"){
              $ty = $request->chalan_no ;
                $purchases = Purchase::whereDate('purchase_date', '>=', $from_date)
                            ->whereDate('purchase_date', '<=', $to_date)
                            ->get();
             }
             else{
                 //$types = Product::find($request->product_id);
                 $ty =  $request->chalan_no;

                $purchases = Purchase::where('chalan_no',$request->chalan_no)
                            ->whereDate('purchase_date', '>=', $from_date)
                            ->whereDate('purchase_date', '<=', $to_date)
                            ->get();
                }
                return view('backend.admin.report.purchase.chalan_purchase_report_index',compact('chalans','purchases','ty','from','to'));
          }
          /*-------------Purchase return report---------------------*/
          if($request->report_type == 'Return') {

            $chalans = DB::select("SELECT DISTINCT purchases.id, purchases.chalan_no from purchases ");
           
            if($request->chalan_no === "All"){
                $ty = $request->chalan_no ;
                  $purchases = PurchaseReturn::whereDate('return_date', '>=', $from_date)
                              ->whereDate('return_date', '<=', $to_date)
                              ->get();
               }
               else{
                   //$types = Product::find($request->product_id);
                   $ty =  $request->chalan_no;
  
                  $purchases = PurchaseReturn::where('chalan_no',$request->chalan_no)
                              ->whereDate('return_date', '>=', $from_date)
                              ->whereDate('return_date', '<=', $to_date)
                              ->get();
                  }
                  return view('backend.admin.report.purchase.chalan_return_report_index',compact('chalans','purchases','ty','from','to'));
            }
          
    }
    /*-
    * pri => p = purchase, r = report , i = index
    * prs => p = purchase, r = report , s = search
    */
    public function pri(Request $request){
         
        
        $products = DB::select("SELECT DISTINCT products.product_name,purchase_details.model_no,purchase_details.product_id from products,purchase_details where products.id = purchase_details.product_id");
        $purchases = '';
        return view('backend.admin.report.purchase.product_purchase_report_index',compact('products','purchases'));
    }
    public function prs(Request $request){
          $from = $request->from_date;
          $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

         
          /*----------purchase report----------------*/
        if($request->report_type == 'Purchase'){
          $products = DB::select("SELECT DISTINCT products.product_name,purchase_details.model_no,purchase_details.product_id from products,purchase_details where products.id = purchase_details.product_id");
          
          if($request->product_id === "All"){
              $ty = $request->product_id ;
                $purchases = PurchaseDetail::whereDate('purchase_date', '>=', $from_date)
                            ->whereDate('purchase_date', '<=', $to_date)
                            ->get();
              }
              else{
                  $types = Product::find($request->product_id);
                  $ty = $types->product_name;

                $purchases = PurchaseDetail::where('product_id',$request->product_id)
                            ->whereDate('purchase_date', '>=', $from_date)
                            ->whereDate('purchase_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.purchase.product_purchase_report_index',compact('products','purchases','ty','from','to'));
      }
       /*----------purchase return report----------------*/
       if($request->report_type == 'Return'){
        $products = DB::select("SELECT DISTINCT products.product_name,purchase_details.model_no,purchase_details.product_id from products,purchase_details where products.id = purchase_details.product_id");
        
        if($request->product_id === "All"){
            $ty = $request->product_id ;
              $purchases = PurchaseReturnDetail::whereDate('return_date', '>=', $from_date)
                          ->whereDate('return_date', '<=', $to_date)
                          ->get();
            }
            else{
                $types = Product::find($request->product_id);
                $ty = $types->product_name;

              $purchases = PurchaseReturnDetail::where('product_id',$request->product_id)
                          ->whereDate('return_date', '>=', $from_date)
                          ->whereDate('return_date', '<=', $to_date)
                          ->get();
              }
        return view('backend.admin.report.purchase.product_purchase_return_report_index',compact('products','purchases','ty','from','to'));
      }
    }
    /*-
    * => supplier wise purchase report
    * spri => s = supplier, p = purchase, r = report , i = index
    * sprs => s = supplier, p = purchase, r = report , s = search
    */
    public function spri(Request $request){
      $suppliers = DB::select("SELECT DISTINCT suppliers.supplier_name,purchase_details.supplier_id from suppliers,purchase_details where suppliers.id = purchase_details.supplier_id");
      $purchases = '';
      return view('backend.admin.report.purchase.supplier_report_index',compact('suppliers','purchases'));
    }
    public function sprs(Request $request){
          $from = $request->from_date;
          $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

          
          $suppliers = DB::select("SELECT DISTINCT suppliers.supplier_name,purchase_details.supplier_id from suppliers,purchase_details where suppliers.id = purchase_details.supplier_id");
        /*----------purchase report supplier wise------------------- */
        if($request->report_type == 'Purchase') {
          if($request->supplier_id === "All"){
              $ty = $request->supplier_id ;
                $purchases = PurchaseDetail::whereDate('purchase_date', '>=', $from_date)
                            ->whereDate('purchase_date', '<=', $to_date)
                            ->get();
             }
             else{
                 $types = Supplier::find($request->supplier_id);
                 $ty = $types->supplier_name;
                $purchases = PurchaseDetail::where('supplier_id',$request->supplier_id)
                            ->whereDate('purchase_date', '>=', $from_date)
                            ->whereDate('purchase_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.purchase.supplier_report_index',compact('suppliers','purchases','ty','from','to'));
        }
        /*-----------purchase return report supplier wise----------------*/
        if($request->report_type == 'Return') {
          if($request->supplier_id === "All"){
              $ty = $request->supplier_id ;
                $purchases = PurchaseReturnDetail::whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
             }
             else{
                 $types = Supplier::find($request->supplier_id);
                 $ty = $types->supplier_name;

                $purchases = PurchasereturnDetail::where('supplier_id',$request->supplier_id)
                            ->whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.purchase.supplier_return_report_index',compact('suppliers','purchases','ty','from','to'));
        }
    }
    /**
     * sale Report section
     */
    /*-
    * isri => i = invoice, s = sale, r = report , i = index
    * isrs => i = invoice, s = sale, r = report , s = search
    */
    public function isri(Request $request){
      
      $invoices = DB::select("SELECT DISTINCT sales.id, sales.invoice_no from sales ");
      $sales = '';
      return view('backend.admin.report.sale.invoice_report_index',compact('invoices','sales'));
    }
    public function isrs(Request $request){
          $from = $request->from_date;
          $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

          
          $invoices = DB::select("SELECT DISTINCT sales.id, sales.invoice_no from sales ");
        /*--------------invoice wise sale report-----------------------*/
        if($request->report_type == 'Sale') {
          if($request->invoice_no === "All"){
              $ty = $request->invoice_no ;
                $sales = Sale::whereDate('sale_date', '>=', $from_date)
                            ->whereDate('sale_date', '<=', $to_date)
                            ->get();
             }
             else{
                 //$types = Product::find($request->product_id);
                 $ty =  $request->invoice_no;

                $sales = Sale::where('invoice_no',$request->invoice_no)
                            ->whereDate('sale_date', '>=', $from_date)
                            ->whereDate('sale_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.sale.invoice_report_index',compact('invoices','sales','ty','from','to'));
        }
        /*--------------------invoice wise return report-------------------------*/
        if($request->report_type == 'Return') {
          if($request->invoice_no === "All"){
              $ty = $request->invoice_no ;
                $sales = SaleReturn::whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
             }
             else{
                 //$types = Product::find($request->product_id);
                 $ty =  $request->invoice_no;

                $sales = SaleReturn::where('invoice_no',$request->invoice_no)
                            ->whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.sale.invoice_return_report_index',compact('invoices','sales','ty','from','to'));
        }

    }
    /*-
    * psri => p = product, s = sale, r = report , i = index
    * psrs => p = product, s = sale, r = report , s = search
    */
    public function psri(Request $request){
         
        
        $products = DB::select("SELECT DISTINCT products.product_name,products.model_no,sale_details.product_id from products,sale_details where products.id = sale_details.product_id");
        $sales = '';
        return view('backend.admin.report.sale.sale_report_index',compact('products','sales'));
    }
    public function psrs(Request $request){
          $from = $request->from_date;
          $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

         
          $products = DB::select("SELECT DISTINCT products.product_name,products.model_no,sale_details.product_id from products,sale_details where products.id = sale_details.product_id");
        /*------------------sale Report product wise------------------------*/
          if($request->report_type == 'Sale')  {
          if($request->product_id === "All"){
              $ty = $request->product_id ;
                $sales = SaleDetail::whereDate('sale_date', '>=', $from_date)
                            ->whereDate('sale_date', '<=', $to_date)
                            ->get();
              }
              else{
                  $types = Product::find($request->product_id);
                  $ty = $types->product_name;

                $sales = SaleDetail::where('product_id',$request->product_id)
                            ->whereDate('sale_date', '>=', $from_date)
                            ->whereDate('sale_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.sale.sale_report_index',compact('products','sales','ty','from','to'));
        }
        /*------------------Sale Return Report product wise------------------------*/
        if($request->report_type == 'Return')  {
          if($request->product_id === "All"){
              $ty = $request->product_id ;
                $sales = SaleReturnDetail::whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
              }
              else{
                  $types = Product::find($request->product_id);
                  $ty = $types->product_name;

                $sales = SaleReturnDetail::where('product_id',$request->product_id)
                            ->whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.sale.sale_return_report_index',compact('products','sales','ty','from','to'));
        }
    }
    /*-
    * csri => c = customer, s = sale, r = report , i = index
    * csrs => c = customer, s = sale, r = report , s = search
    */
    public function csri(Request $request){
      
      $customers = DB::select("SELECT DISTINCT customers.customer_name,sale_details.customer_id from customers,sale_details where customers.id = sale_details.customer_id");
      $sales = '';
      return view('backend.admin.report.sale.customer_report_index',compact('customers','sales'));
    }
    public function csrs(Request $request){
          $from = $request->from_date;
          $to = $request->to_date;

          $from_date = date_create($request->from_date);
          $to_date = date_create($request->to_date);

          
          $customers = DB::select("SELECT DISTINCT customers.customer_name,sale_details.customer_id from customers,sale_details where customers.id = sale_details.customer_id");
        /*-------------sale report customer wise---------------------*/
          if($request->report_type == 'Sale'){ 
          if($request->customer_id === "All"){
              $ty = $request->customer_id ;
                $sales = SaleDetail::whereDate('sale_date', '>=', $from_date)
                            ->whereDate('sale_date', '<=', $to_date)
                            ->get();
             }
             else{
                 $types = Customer::find($request->customer_id);
                 $ty = $types->customer_name;

                $sales = SaleDetail::where('customer_id',$request->customer_id)
                            ->whereDate('sale_date', '>=', $from_date)
                            ->whereDate('sale_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.sale.customer_report_index',compact('customers','sales','ty','from','to'));
        }
         /*-------------sale return report customer wise---------------------*/
         if($request->report_type == 'Return'){ 
          if($request->customer_id === "All"){
              $ty = $request->customer_id ;
                $sales = SaleReturnDetail::whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
             }
             else{
                 $types = Customer::find($request->customer_id);
                 $ty = $types->customer_name;

                $sales = SaleReturnDetail::where('customer_id',$request->customer_id)
                            ->whereDate('return_date', '>=', $from_date)
                            ->whereDate('return_date', '<=', $to_date)
                            ->get();
                }
          return view('backend.admin.report.sale.customer_return_report_index',compact('customers','sales','ty','from','to'));
        }
    }
    /**
     * wastage return 
     */
    /*-
    * pri => p = purchase, r = report , i = index
    * prs => p = purchase, r = report , s = search
    */
    public function wri(Request $request){
         
      
      $products = DB::select("SELECT DISTINCT products.product_name,purchase_details.model_no,purchase_details.product_id from products,purchase_details where products.id = purchase_details.product_id");
      $purchases = '';
      return view('backend.admin.report.wastage.wastage_report_index',compact('products','purchases'));
  }
  public function wrs(Request $request){
        $from = $request->from_date;
        $to = $request->to_date;

        $from_date = date_create($request->from_date);
        $to_date = date_create($request->to_date);

        
        $products = DB::select("SELECT DISTINCT products.product_name,purchase_details.model_no,purchase_details.product_id from products,purchase_details where products.id = purchase_details.product_id");
        
        if($request->product_id === "All"){
            $ty = $request->product_id ;
              $purchases = WastageReturn::whereDate('return_date', '>=', $from_date)
                          ->whereDate('return_date', '<=', $to_date)
                          ->get();
            }
            else{
                $types = Product::find($request->product_id);
                $ty = $types->product_name;

              $purchases = WastageReturn::where('product_id',$request->product_id)
                          ->whereDate('return_date', '>=', $from_date)
                          ->whereDate('return_date', '<=', $to_date)
                          ->get();
              }
        return view('backend.admin.report.wastage.wastage_report_index',compact('products','purchases','ty','from','to'));
  }
}
