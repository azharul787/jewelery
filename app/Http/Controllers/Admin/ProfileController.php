<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function changeProfile(Request $request)
		{
           // $profile = Auth::all();
           // return $request->all();
			return view('auth.profile.change');
        }
    /***
     * 
     */
    public function updateprofile(Request $request)
    {
       // return $request->all();

        $image = $request->file('image');
        $slug = str_slug($request->user_name);
        $user = User::find(Auth::id());
        //return $user;
        if (isset($image))
        {
		// make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
		//check user dir is exists
            if (!Storage::disk('public')->exists('user'))
            {
                Storage::disk('public')->makeDirectory('user');
            }
		//delete old image
            if (Storage::disk('public')->exists('user/'.$user->image))
            {
                Storage::disk('public')->delete('user/'.$user->image);
            }
		//resize image for user and upload
            $userimage = Image::make($image)->resize(128,128)->stream();
            Storage::disk('public')->put('user/'.$imagename,$userimage);

        } else {
            $imagename = $user->image;
        }
        $user->name = $request->user_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->image = $imagename;
        $user->save();

        return redirect()->route('home')->with('success','User profile Update Successfull');
    }
}
