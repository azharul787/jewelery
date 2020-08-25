<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Model\Loaner;
use DB;

class LoanerController extends Controller
{
   /*-----------ACL Base Role Permission system  @Azharul-------------------*/
   function __construct()
   {
        $this->middleware('permission:loaner-list');
        $this->middleware('permission:loaner-entry', ['only' => ['create','store']]);
        $this->middleware('permission:loaner-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:loaner-delete', ['only' => ['destroy']]);
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
      /* $show = $request->show;
       if($show != ''){
           $loaners = Loaner::latest()->paginate($show);
       }else{
           $loaners = Loaner::latest()->paginate(10);
       }*/
       
      $loaners = DB::select("SELECT lo.id, lo.loaner_name,lo.loaner_phone,lo.loaner_address, (sum(l.debit) - sum(l.credit)) as balance
                                FROM loaners lo 
                                LEFT JOIN loans l 
                                ON lo.id = l.loaner_id 
                                GROUP by l.loaner_id");

                    //return $loaners;
      /*  $perPage = $request->input("per_page", 10);
        $page = $request->input("page", 1);
        $skip = $page * $perPage;
        if($page < 1) { $page = 1; }
        if($skip < 0) { $skip = 0; }
        
        $basicQuery = DB::select(DB::raw("SELECT loaners.*, loans.loaner_id,loans.transaction_date, (sum(loans.debit) - sum(loans.credit)) as balance
                            FROM loaners, loans
                            WHERE loaners.id = loans.loaner_id 
                            GROUP BY loans.loaner_id"));

        $totalCount = $basicQuery->count();
        $results = $basicQuery
            ->take($perPage)
            ->skip($skip)
            ->get();
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($results, $totalCount, $take, $page);
                    
        return $paginator;

*/
       return view('backend.admin.loaner.index',compact('loaners'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('backend.admin.loaner.create');
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
           'name'=>'required',
           'phone'=>'required',
          'address'=>'required'
       ]);
       

       $loaner = new Loaner();
       $loaner->loaner_name = $request->name;
       $loaner->loaner_phone = $request->phone;
       $loaner->loaner_address = $request->address;
       $loaner->save();

       return redirect()->route('admin.loaner.index')->with('success','Loaner Information Save Successfull');

   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       $loaner = Loaner::find($id);

       return view('backend.admin.loaner.edit',compact('loaner'));
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
           'name'=>'required',
           'phone'=>'required',
           'address'=>'required'
       ]);

       $loaner = Loaner::find($id);
       $loaner->loaner_name = $request->name;
       $loaner->loaner_phone = $request->phone;
       $loaner->loaner_address = $request->address;
       $loaner->save();

       return redirect()->route('admin.loaner.index')->with('success','Loaner Information Update Successfull');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $loaner = Loaner::find($id);
       $loaner->delete();

       return redirect()->back()->with('success','Loaner Information Successfully Deleted ');
   }
}
