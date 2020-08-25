<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Setting;

class SettingController extends Controller
{
    function __construct(){
        $this->middleware('permission:setting-group', ['only' => ['edit','update']]);
    }
    public function edit(){
        return view('backend.admin.setting.edit');
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'sale_profit_percentage' => 'required',
            'vat_percentage' => 'required',
            'per_10_gram_price' => 'required',
            'customer_wage_per_gram' => 'required',
            'worker_wage_per_gram' => 'required',
            'ddspinp' => 'required',
        ]);

        $setting = Setting($id);
        $setting->sale_profit_percentage = $request->sale_profit_percentage;
        $setting->vat_percentage = $request->vat_percentage;
        $setting->per_10_gm_price = $request->per_10_gram_price;
        $setting->customer_wage_per_gram = $request->customer_wage_per_gram;
        $setting->worker_wage_per_gram = $request->worker_wage_per_gram;
        $setting->ddspinp = $request->ddspinp;
        $setting->updated_by = Auth::id();
        $setting->save();

        return back()->with('success','Global Setting Information Update Successfully');
    }
}
