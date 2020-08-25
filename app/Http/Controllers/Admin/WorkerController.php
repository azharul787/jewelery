<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Model\Unit;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Worker;

class WorkerController extends Controller
{
    /*-----------ACL Base Role Permission system  @Azharul-------------------*/
    function __construct()
    {
         $this->middleware('permission:worker-list');
         $this->middleware('permission:worker-entry', ['only' => ['create','store']]);
         $this->middleware('permission:worker-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:worker-delete', ['only' => ['destroy']]);
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
            $workers = Worker::latest()->paginate($show);
        }else{
            $workers = Worker::latest()->paginate(10);
        }
		
        return view('backend.admin.worker.index',compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.worker.create');
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
        

        $worker = new Worker();
        $worker->name = $request->name;
        $worker->phone = $request->phone;
        $worker->address = $request->address;
        $worker->save();

        return redirect()->route('admin.worker.index')->with('success','Worker Information Save Successfull');

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
        $worker = Worker::find($id);
        return view('backend.admin.worker.edit',compact('worker','workers'));
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

        $worker = Worker::find($id);
        $worker->name = $request->name;
        $worker->phone = $request->phone;
        $worker->address = $request->address;
        $worker->save();

        return redirect()->route('admin.worker.index')->with('success','Worker Information Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$worker = Worker::find($id);
        $worker->delete();

        return redirect()->back()->with('success','Worker Information Successfully Deleted ');
    }
}
