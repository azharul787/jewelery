<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\About;
use App\Model\Bank;
use App\Model\BankTransaction;
use DB;

class BankTransactionController extends Controller
{
    /*-----------ACL Base Role Permission system  @Azharul-------------------*/
    function __construct()
    {
         $this->middleware('permission:bank-transaction-list');
         $this->middleware('permission:bank-transaction-entry', ['only' => ['create','store']]);
         $this->middleware('permission:bank-transaction-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bank-transaction-delete', ['only' => ['destroy']]);
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
            $banks = BankTransaction::latest()->paginate($show);
        }else{
            $banks = BankTransaction::latest()->paginate(10);
        }
        return view('backend.admin.bank_transaction.index',compact('banks'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::orderBy('bank_name')->get();
        return view('backend.admin.bank_transaction.create',compact('banks'));
    }
    /*-----------get account no----------*/
    public function accountNo(Request $request){
        $data = Bank::find($request->bank_id);
        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $closing =  DB::table('cash_closings')->where('closing_date', date('Y-m-d',strtotime($request->transaction_date)))->exists();
        if($closing != true){
            $this->validate($request,[
                'bank_name'=>'required',
                'transaction_amount'=>'required',
                'transaction_status'=>'required',
                'transaction_date'=>'required',
                ]);
            if($request->transaction_status == 'Withdraw'){
                /*----------query the bank total diposit and withdraw balance-----------------------*/
                $cbalance = DB::select("SELECT bank_id, 
                                        SUM(IF(transaction_status = 'Deposit', transaction_amount, 0)) AS total_deposit,
                                        SUM(IF(transaction_status = 'Withdraw', transaction_amount, 0)) AS total_withdraw 
                                    FROM bank_transactions 
                                    WHERE bank_id = $request->bank_name
                                    GROUP BY bank_id
                            ");
                
                foreach($cbalance as $cbl){
                    $cb = $cbl->total_deposit - $cbl->total_withdraw;
                }
            //return $cb;
            /*--------------if withdraw amount is less than bank current balance then execute this section---------------*/
                if($cb > $request->transaction_amount){
                    $ban = new BankTransaction();
                    $ban->bank_id = $request->bank_name;
                    $ban->user_id = Auth::id();
                    $ban->account_no = $request->account_no;
                    $ban->cheque_no = $request->cheque_no;
                    $ban->transaction_status = $request->transaction_status;
                    $ban->transaction_amount = $request->transaction_amount;
                    $dt = Carbon::parse($request->transaction_date);
                    $ban->transaction_date = $dt->toDateTimeString();
                    $ban->note = $request->note;
                    $ban->save();
                }
                /*--------------if withdraw amount is gater than bank current balance then execute this section--------------------*/
                else{
                    return redirect()->back()->with('warning','Woops! Current bank balance is not enough');
                }
            }else{
                /*-----------if transaction status is deposit then nothing to check----------------*/   
                    $ban = new BankTransaction();
                    $ban->bank_id = $request->bank_name;
                    $ban->user_id = Auth::id();
                    $ban->account_no = $request->account_no;
                    $ban->cheque_no = $request->cheque_no;
                    $ban->transaction_status = $request->transaction_status;
                    $ban->transaction_amount = $request->transaction_amount;
                    $dt = Carbon::parse($request->transaction_date);
                    $ban->transaction_date = $dt->toDateTimeString();
                    $ban->note = $request->note;
                    $ban->save();
            }
            return redirect()->route('admin.bank_transaction.index')->with('success','Bank Transaction Save Successfull');
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
       $from_date =  date('Y-m-01') ;
       $to_date = date('Y-m-d');

        
        $bank = Bank::find($id);
        $banks = Bank::orderBy('bank_name','ASC')->get();
        $transactions = BankTransaction::where('bank_id',$id)
                                        ->whereDate('transaction_date', '>=', $from_date)
                                        ->whereDate('transaction_date', '<=', $to_date)
                                        ->get();

        return view('backend.admin.bank_transaction.show',compact('banks','bank','transactions','from_date','to_date')); 
    }
    /*--------------bank wise transaction list------------------*/
    public function btlist(Request $request){
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date)) ;
        $bank_id = $request->bank_id; 

       
        $bank = Bank::find($bank_id);
        $banks = Bank::orderBy('bank_name','ASC')->get();
        $transactions = BankTransaction::where('bank_id',$bank_id)
                                        ->whereDate('transaction_date', '>=', $from_date)
                                        ->whereDate('transaction_date', '<=', $to_date)
                                        ->get();

        return view('backend.admin.bank_transaction.show',compact('banks','bank','transactions','from_date','to_date')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankt = BankTransaction::find($id);
        $banks = Bank::orderBy('bank_name')->get();
        return view('backend.admin.bank_transaction.edit',compact('bankt','banks')); 
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
            'bank_name'=>'required',
            'transaction_amount'=>'required',
            'transaction_status'=>'required',
            'transaction_date'=>'required',
            ]);
        if($request->transaction_status == 'Withdraw'){
            /*----------query the bank total diposit and withdraw balance-----------------------*/
            $cbalance = DB::select("SELECT bank_id, 
                                    SUM(IF(transaction_status = 'Deposit', transaction_amount, 0)) AS total_deposit,
                                    SUM(IF(transaction_status = 'Withdraw', transaction_amount, 0)) AS total_withdraw 
                                FROM bank_transactions 
                                WHERE bank_id = $request->bank_name
                                GROUP BY bank_id
                        ");
            
            foreach($cbalance as $cbl){
                $cb = $cbl->total_deposit - $cbl->total_withdraw;
            }
           //return $cb;
           /*--------------if withdraw amount is less than bank current balance then execute this section---------------*/
           $ban = BankTransaction::find($id);
            /*--------add edited balance to current balance -------------*/
           if(($cb + $ban->transaction_amount) > $request->transaction_amount){
                
                $ban->bank_id = $request->bank_name;
                $ban->user_id = Auth::id();
                $ban->account_no = $request->account_no;
                $ban->cheque_no = $request->cheque_no;
                $ban->transaction_status = $request->transaction_status;
                $ban->transaction_amount = $request->transaction_amount;
                $dt = Carbon::parse($request->transaction_date);
                $ban->transaction_date = $dt->toDateTimeString();
                $ban->note = $request->note;
                $ban->save();
            }
              /*--------------if withdraw amount is gater than bank current balance then execute this section--------------------*/
            else{
                return redirect()->back()->with('warning','Woops! Current bank balance is not enough');
            }
        }else{
            /*-----------if transaction status is deposit then nothing to check----------------*/   
                $ban = BankTransaction::find($id);
                $ban->bank_id = $request->bank_name;
                $ban->user_id = Auth::id();
                $ban->account_no = $request->account_no;
                $ban->cheque_no = $request->cheque_no;
                $ban->transaction_status = $request->transaction_status;
                $ban->transaction_amount = $request->transaction_amount;
                $dt = Carbon::parse($request->transaction_date);
                $ban->transaction_date = $dt->toDateTimeString();
                $ban->note = $request->note;
                $ban->save();
        }

        return redirect()->route('admin.bank_transaction.index')->with('success','Bank Transaction Save Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = BankTransaction::find($id);
        $bank->delete();
        return redirect()->back()->with('success','Bank Transaction Information Delete Successfull');
    }
}
