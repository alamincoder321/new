<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
class ProductController extends Controller
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
        $products = Product::latest()->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->latest()->get();
        $suppliers = Supplier::where('status', 1)->latest()->get();
        return view('product.create', compact('categories','suppliers'));
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
            'name'          => 'required',
            'buy_cost'      => 'required',
            'unit_cost'     => 'required',
            'weight'        => 'required',
            'category_id'   => 'required',
            'supplier_id'   => 'required',
        ],[
            'category_id.required' => 'Select category name',
            'supplier_id.required' => 'Select supplier name',
        ]);

        $product = Product::where([
            ['category_id', $request->category_id],
            ['supplier_id', $request->supplier_id],
            ['name', $request->name]
        ])->first();

        if ($product) {
            $product->increment('weight', $request->weight);
            Toastr::success('Product added successfully!');
            return back();
        }else{
            Product::insert([
                'name'          => ucwords($request->name),
                'buy_cost'      => $request->buy_cost,
                'unit_cost'     => $request->unit_cost,
                'tweight'       => $request->weight,
                'weight'        => $request->weight,
                'category_id'   => $request->category_id,
                'supplier_id'   => $request->supplier_id,
                'created_at'    => Carbon::now()   
            ]);

            Toastr::success('Product added successfully!');
            return back();
        }
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
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 1)->latest()->get();
        $suppliers = Supplier::where('status', 1)->latest()->get();
        return view('product.edit', compact('product','categories','suppliers'));
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
            'name'          => 'required',
            'unit_cost'     => 'required',
            'weight'        => 'required',
            'category_id'   => 'required',
            'supplier_id'   => 'required',
        ],[
            'category_id.required' => 'Select category name',
            'supplier_id.required' => 'Select supplier name'
        ]);

        $product = Product::findOrFail($id);
        $product->name          = ucwords($request->name);
        $product->buy_cost      = $request->buy_cost;
        $product->unit_cost     = $request->unit_cost;
        $product->tweight       = $request->weight;
        $product->weight        = $request->weight;
        $product->category_id   = $request->category_id;
        $product->supplier_id   = $request->supplier_id;
        $product->updated_at    = Carbon::now();
        $product->update();
        
        Toastr::success('Product updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        Toastr::error('Product delete successfully!');
        return back();
    }

    //============== Product active =========

    public function Active($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Product Active successfully!');
        return back();
    }

    //============== Product inactive =========

    public function Inactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Product Inactive successfully!');
        return back();
    }
}
