<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Warehouse;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Sale;
use App\Model\SaleDetail;
use App\Model\SaleReturnDetail;
use App\Model\SaleReturn;
use App\Model\Order;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use App\Model\PurchaseReturn;
use App\Model\PurchaseReturnDetail;
use App\Model\WastageReturn;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //return view('home');
       /* $wr = Warehouse::orderBy('warehouse_code','ASC')->get();
        $request->session()->put('warehouses', $wr);*/

        /*----------------------*/

        $products = Product::all()->count();
        $customers = Customer::all()->count();
        $suppliers = Supplier::all()->count();
        $orders = Order::all()->count();
        $stockins = Order::where('status','Stocked')->count();
        $pendings = Order::where('status','Pending')->count();
        $purchases = Purchase::all()->count();
        $purchaseDetails = PurchaseDetail::all();
        $preturn = PurchaseReturn::all()->count();
        $prqty = PurchaseReturnDetail::sum('quantity');
        $wastage = WastageReturn::sum('return_quantity');
        $invoices = Sale::all()->count();
        $sale_qty = SaleDetail::sum('quantity');
        $sreturn = SaleReturn::all()->count();
        $stocks = DB::table('product_stocks')->sum('product_stock');
        $assets = DB::table('expenses')->where('expensetype_id',5)->sum('expense_amount');
        // last 30 day sale rep[ort
        $sl = DB::select("SELECT YEAR(sale_date) AS Y, MONTH(sale_date) AS m, DAY(sale_date) AS d, sale_date, SUM(grand_total_price) AS sale_total FROM sales WHERE sale_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() GROUP BY sale_date");
        $sale = array();
        foreach($sl as $i=>$ss){
            $sale[] = ['date' =>$i, 'value' =>$ss->sale_total ];
        }
        // last year sale report
        $year_sale = DB::select("SELECT YEAR(sale_date) AS Y, MONTH(sale_date) AS m, DAY(sale_date) AS d, sale_date, SUM(grand_total_price) AS sale_total FROM sales WHERE sale_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW() GROUP BY Y, m");
        $barchat_sale = array();
        foreach($year_sale as $i=>$yy){
            $barchat_sale[] = [ "y" => date('F',strtotime($yy->sale_date)), "a" => $yy->sale_total];
        }

        // last year sale return report
        $dd = DB::select("SELECT YEAR(return_date) AS Y, MONTH(return_date) AS m, DAY(return_date) AS d, return_date, SUM(grand_total_price) AS return_total FROM sale_returns WHERE return_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW() GROUP BY Y, m");
        $sale_return = array();
        foreach($dd as $i=>$mm){
            $sale_return[] = ['y' => date('Y',strtotime($mm->return_date)), 'a' =>$mm->return_total ];
        }

        //return $barchat_sale;
        return view('backend.admin.dashboard',compact('products','customers','suppliers','orders','stockins','pendings','purchases','wastage','purchaseDetails','prqty','barchat_sale','invoices','sale','sale_return','sale_qty','stocks','assets'));
    }
}
