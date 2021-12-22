<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Due;

class ReportController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $customers = Customer::latest()->get();
        
        return view('report.index', compact('customers'));
    }

    public function dueShow($id)
    {
        $due        = Due::where('customer_id', $id)->latest()->get()->sum('pay_due');

        $customer   = Customer::findOrFail($id);

        $orders     = Order::where('customer_id', $id)->latest()->get();
        $d          = Order::where('customer_id', $id)->latest()->get()->sum('due');

        $paytotal   = Order::where('customer_id', $id)->latest()->get()->sum('pay_amount');
        $t          = Order::where('customer_id', $id)->latest()->get()->sum('total');

        return view('report.due', compact('customer', 'orders', 'd', 't', 'paytotal', 'due'));
    }



    public function DuePay(Request $request)
    {
        $this->validate($request, [
            'pay_due' => 'required',
        ]);

        $due = new Due;
        $due->customer_id   = $request->customer_id;
        $due->pay_due      = $request->pay_due;
        $due->pay_date      = $request->pay_date;
        $due->month      = $request->month;
        $due->save();

        Toastr::success('Due Pay Successfully!');
        return back();
    }


    public function duelist($id)
    {
        $dues = Due::where('customer_id', $id)->latest()->get();

        return view('report.duelist', compact('dues'));
    }

    public function paydue()
    {
        $customers = Customer::latest()->get();
        
        return view('report.pay_due', compact('customers'));
    }
}