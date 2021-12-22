<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Category;
use App\Models\Product;

use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('category.index', compact('categories'));
    }
    
    public function loadProduct( $id){

        $products= Product::where('category_id',$id)->get();
        return view('pos.product',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|unique:categories',
        ]);

        $category = new Category;
        $category->name       = ucwords($request->name);
        $category->created_at = Carbon::now();
        $category->save();

        Toastr::success('Category added successfully!');
        return back();
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
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
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
            'name'      => 'required|unique:categories',
        ]);

        $category = Category::findOrFail($id);
        $category->name       = ucwords($request->name);
        $category->updated_at = Carbon::now();
        $category->update();

        Toastr::success('Category update successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Toastr::error('Category delete successfully!');
        return back();
    }


    //============== Category active =========

    public function Active($id)
    {
        Category::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Category Active successfully!');
        return back();
    }

    //============== Category inactive =========

    public function Inactive($id)
    {
        Category::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Category Inactive successfully!');
        return back();
    }
}
