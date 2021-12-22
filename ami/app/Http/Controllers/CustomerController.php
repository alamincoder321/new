<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    public function Load()
    {
        return view('pos.load_newcustomer');
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
            'name'         => 'required',
            'phone'         => 'required|min:11',
            'city_name'     => 'required',
            'upozila'       => 'required',
        ]);

        Customer::insert([
            'name'     => ucwords($request->name),
            'phone'     => $request->phone,
            'city_name' => ucwords($request->city_name),
            'upozila'   => ucwords($request->upozila),
            'created_at'=> Carbon::now()
        ]);

        Toastr::success('Customer added Successfully');
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
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
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
            'name'         => 'required',
            'phone'         => 'required',
            'city_name'     => 'required',
            'upozila'       => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name     = ucwords($request->name);
        $customer->phone     = $request->phone;
        $customer->city_name = ucwords($request->city_name);
        $customer->upozila   = ucwords($request->upozila);
        $customer->updated_at= Carbon::now();
        $customer->update();

        Toastr::success('Customer updated Successfully!');
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        Toastr::error('Customer delete Successfully!');
        return back();
    }

    //============== Customer active =========

    public function Active($id)
    {
        Customer::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Customer Active successfully!');
        return back();
    }

    //============== Customer inactive =========

    public function Inactive($id)
    {
        Customer::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Customer Inactive successfully!');
        return back();
    }

}
