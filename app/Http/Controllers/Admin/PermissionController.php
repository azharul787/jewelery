<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
     /**
    * Role and permission implement by ****** 
    * >>>>>> Md Azharul Islam
    * >>>>>> email: azharul787@gmail.com
    *>>>>>>> Software Developer
    * >>>>>> This function call automatically when call this method
    */
   function __construct()
    {
         $this->middleware('permission:permission-list');
         $this->middleware('permission:permission-entry', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
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
            $permissions = Permission::latest()->paginate($show);
        }
       else{
            $permissions = Permission::latest()->paginate(10);
       }
        return view('backend.admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('backend.admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
            'name' => 'required|unique:permissions',
        ]);

        $permission = $request->name;
        Permission::create(['name' => $permission]);

        return redirect()->route('admin.permission.index')->with('success','Permission Entry Success');
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
        $permission = Permission::find($id);
        $permissions = Permission::latest()->paginate(10);
        return view('backend.admin.permission.edit',compact('permission','permissions'));
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
        $this->validate($request, [
            'permission_name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->permission_name;
        $permission->save();

        return redirect()->route('admin.permission.index')->with('success','Permission Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->route('admin.permission.index')->with('success','Permission Delete Success');
    }
}
