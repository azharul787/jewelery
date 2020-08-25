<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bank;
class BankController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:bank-name-list');
         $this->middleware('permission:bank-name-entry', ['only' => ['create','store']]);
         $this->middleware('permission:bank-name-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bank-name-delete', ['only' => ['destroy']]);
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
            $banks = Bank::latest()->paginate($show);
        }else{
            $banks = Bank::latest()->paginate(10);
        }
        return view('backend.admin.bank.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.bank.create');
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
            'bank_name'=>'required',
            'branch_name'=>'required',
            ]);
            
            $bank = new Bank();
            $bank->bank_name = $request->bank_name;
            $bank->account_no = $request->account_no;
            $bank->branch_name = $request->branch_name;
            $bank->bank_location = $request->bank_location;
            $bank->save();
            

            return redirect()->route('admin.bank.index')->with('success','Bank Information Save Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return view('backend.admin.bank.edit',compact('bank'));
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
            'branch_name'=>'required'
        ]);
        $bank = Bank::find($id);
        $bank->bank_name = $request->bank_name;
        $bank->account_no = $request->account_no;
        $bank->branch_name = $request->branch_name;
        $bank->bank_location = $request->bank_location;
        $bank->save();

        return redirect()->route('admin.bank.index')->with('success','Bank information Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        return redirect()->back()->with('success','Bank Information Delete Successfull');
    }
}
