<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:category-list');
         $this->middleware('permission:category-entry', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
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
            $categories = Category::latest()->paginate($show);
        }else{
            $categories = Category::latest()->paginate(10);
        }
		
        return view('backend.admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('backend.category.create');
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
        'category_name'=>'required|unique:categories'
        ]);
		
		$category = new Category();
		$category->category_name = $request->category_name;
		$category->save();
		
		return redirect()->route('admin.category.index')->with('success','Category List Save Successfull');
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
        $category = Category::find($id);
        $categories = Category::latest()->paginate(10);
		return view('backend.admin.category.edit',compact('category','categories'));
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
       // 'category_name'=>'required|unique:categories'
		'category_name'=>'required'
    ]);
		
		$category = Category::find($id);
		$category->category_name = $request->category_name;
		$category->save();

		return redirect()->route('admin.category.index')->with('success','Category List Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
		$category = Category::find($id);
		$category->delete();

		return redirect()->back()->with('success','Category List Delete Successfull');
    }
}
