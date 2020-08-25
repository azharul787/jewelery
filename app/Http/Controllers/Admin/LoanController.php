<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Model\About;
use App\Model\Loaner;
use App\Model\Loan;
use DB;

class LoanController extends Controller
{
    /*-----------ACL Base Role Permission system  @Azharul-------------------*/
   function __construct()
   {
        $this->middleware('permission:loan-list');
        $this->middleware('permission:loan-entry', ['only' => ['create','store']]);
        $this->middleware('permission:loan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:loan-delete', ['only' => ['destroy']]);
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
            $loans = Loan::latest()->paginate($show);
        }else{
            $loans = Loan::latest()->paginate(10);
        }
        return view('backend.admin.loan.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loaners = Loaner::orderBy('loaner_name','ASC')->get();
        return view('backend.admin.loan.loan_create',compact('loaners'));
    }
    /*-----------------------------------*/
    public function lreceive()
    {
        $loaners = Loaner::orderBy('loaner_name','ASC')->get();
        return view('backend.admin.loan.loan_receive',compact('loaners'));
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
            if($request->status == 'Debit'){
                
                $this->validate($request,[
                    'loaner_name'=>'required',
                    'transaction_date'=>'required',
                    'loan_amount'=>'required'
                ]);
                /*--------------------check current balance-------------------
                => cash in hand 
                => if cash in hand balance not enough then transaction will fail
                -----------------------------------------*/

                $loan = new Loan();
                $loan->loaner_id = $request->loaner_name;
                $loan->user_id = Auth::id();
                $dt = Carbon::parse($request->transaction_date);
                $loan->transaction_date = $dt->toDateTimeString();
                $loan->debit = $request->loan_amount;
                $loan->note = $request->note;
                $loan->created_by = Auth::id();
                $loan->save();
        
                return redirect()->route('admin.loaner.index')->with('success','Loaner Information Save Successfull');
            }
            if($request->status == 'Credit'){
                
                $this->validate($request,[
                    'loaner_name'=>'required',
                    'transaction_date'=>'required',
                    'loan_amount'=>'required'
                ]);
                /*--------------------check current balance-------------------*/
                
                $loan = new Loan();
                $loan->loaner_id = $request->loaner_name;
                $loan->user_id = Auth::id();
                $dt = Carbon::parse($request->transaction_date);
                $loan->transaction_date = $dt->toDateTimeString();
                $loan->credit = $request->loan_amount;
                $loan->note = $request->note;
                $loan->created_by = Auth::id();
                $loan->save();
        
                return redirect()->route('admin.loaner.index')->with('success','Loaner Information Save Successfull');
            }
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
 
         $about = About::find(1);
         $loan = Loaner::find($id);
         $loaners = Loaner::orderBy('loaner_name','ASC')->get();
         $transactions = Loan::where('loaner_id',$id)
                                         ->whereDate('transaction_date', '>=', $from_date)
                                         ->whereDate('transaction_date', '<=', $to_date)
                                         ->get();
 
         return view('backend.admin.loan.show',compact('about','loaners','loan','transactions','from_date','to_date')); 
    }
    /*--------------Loan Person wise transaction list------------------*/
    public function ltlist(Request $request){

        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date)) ;
        $loaner_id = $request->loaner_id; 

        $about = About::find(1);
        $loan = Loaner::find($loaner_id);
        $loaners = Loaner::orderBy('loaner_name','ASC')->get();
        $transactions = Loan::where('loaner_id',$loaner_id)
                                         ->whereDate('transaction_date', '>=', $from_date)
                                         ->whereDate('transaction_date', '<=', $to_date)
                                         ->get();

        return view('backend.admin.loan.show',compact('about','loaners','loan','transactions','from_date','to_date')); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
