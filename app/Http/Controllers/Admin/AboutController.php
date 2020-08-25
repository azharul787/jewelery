<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return 'welcome';
        $about = About::findOrFail(1);
        return view('backend.admin.about.create',compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
         // get form image
         $image = $request->file('logo');
         $icon = $request->file('favicon');
 
         $about =  About::findOrFail($id);
 
       //  $slug = str_slug($request->eng_name);
       
        
         /**for member document image */
         if (isset($icon))
         {
             //make unique name for image
             $currentDate = Carbon::now()->toDateString();
             // for profile image
             $ab = 'favicon'.'-'.$currentDate.'-'.uniqid().'.'.$icon->getClientOriginalExtension();
             
             //check member dir is exists
             if (!Storage::disk('public')->exists('about'))
             {
                 Storage::disk('public')->makeDirectory('about');
             }
             //delete old image
             if (Storage::disk('public')->exists('about/'.$about->favicon))
             {
                 Storage::disk('public')->delete('about/'.$about->favicon);
             }
             //resize image for member and upload
             $doc = Image::make($icon)->resize(55,55)->stream();
             Storage::disk('public')->put('about/'.$ab,$doc);
 
         } else {
             $ab = $about->favicon;
         }
 
         if (isset($image))
         {
             //make unique name for image
             $currentDate = Carbon::now()->toDateString();
             // for profile image
             $imagename = 'logo'.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
             
             //check icon dir is exists
             if (!Storage::disk('public')->exists('about'))
             {
                 Storage::disk('public')->makeDirectory('about');
             }
             //delete old image
            if (Storage::disk('public')->exists('about/'.$about->logo))
             {
                 Storage::disk('public')->delete('about/'.$about->logo);
             }
             //resize image for icon and upload
             $lo = Image::make($image)->resize(250,250)->stream();
             Storage::disk('public')->put('about/'.$imagename,$lo);
         } 
         else {
             $imagename = $about->logo;
         }
       
 
         $about->bangla_name = $request->bang_name;
         $about->english_name = $request->eng_name;
         $about->founder = $request->founder;
         $dt2 = Carbon::parse($request->est_year);
         $about->establish_year = $dt2->toDateTimeString();
         $about->phone = $request->phone;
         $about->email = $request->email;
         $about->web = $request->web;
         $about->address = $request->address;
         $about->about = $request->about;
         $about->favicon = $ab;
         $about->logo = $imagename;
         $about->save();
 
         return redirect()->route('admin.about.index')->with('success','Information save Success');
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
