<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class SupplierController extends Controller
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
        $suppliers = Supplier::latest()->get();
        return view('supplier.index', compact('suppliers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            'name'  => 'required',
            'address'   => 'required',
            'phone1'    => 'required|min:11|numeric',
            'phone2'    => 'required|min:11|numeric'
        ]);

        $supplier = new Supplier;
        $supplier->name     = ucwords($request->name);
        $supplier->address  = ucwords($request->address);
        $supplier->phone1   = $request->phone1;
        $supplier->phone2   = $request->phone2;
        $supplier->created_at = Carbon::now();
        $supplier->save();

        Toastr::success('Supplier added successfully!');
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
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
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
            'name'  => 'required',
            'address'   => 'required',
            'phone1'    => 'required|min:11',
            'phone2'    => 'required|min:11'
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->name     = ucwords($request->name);
        $supplier->address  = ucwords($request->address);
        $supplier->phone1   = $request->phone1;
        $supplier->phone2   = $request->phone2;
        $supplier->updated_at = Carbon::now();
        $supplier->update();

        Toastr::success('Supplier updated successfully!');
        return redirect()->route('supplier.index');
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


    //============== Supplier active =========

    public function Active($id)
    {
        Supplier::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Supplier Active successfully!');
        return back();
    }

    //============== Supplier inactive =========

    public function Inactive($id)
    {
        Supplier::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Supplier Inactive successfully!');
        return back();
    }

}
