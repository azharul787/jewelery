<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct()
		{
			$this->middleware('auth');
		}
	/*
	*
	*
	*/
    public function index()
		{
			return view('auth.passwords.change');
		}
	/*
	*
	*
	*/
	public function update(Request $request)
		{ 
			//return $request->all();
			$this->validate($request,[
			'oldPassword'=>'required',
			'password'=>'required|confirmed']);
			
			$hashedPassword = Auth::user()->password;
			//return $hashedPassword;
			if(Hash::check($request->oldPassword,$hashedPassword)){
				$user = User::find(Auth::id());
				$user->password = Hash::make($request->password);
				$user->save();
				
				return back()->with('success','Password Change Successful');
				Auth::logout();
				return redirect()->route('login');
			}
			else
			{
				return back()->with('error','Current Passoword is invalis');
				return redirect()->back();
			}
		}
}
