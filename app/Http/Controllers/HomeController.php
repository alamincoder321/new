<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Due;
use App\Models\Salary;
use App\Models\Expense;
use App\Models\Setting;

class HomeController extends Controller
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
        $date = date("d.m.Y");
        $month = date('m.Y');

//monthly expense
$mexpense = Expense::where('month', $month)->latest()->get()->sum('amount');
//monthly salary
$msalary = Salary::where('month', $month)->latest()->get()->sum('advance_pay');
//monthly order
$morders = Order::where('month', $month)->latest()->get();
//monthly due
$mdue = Order::where('month', $month)->latest()->get()->sum('due');
//monthly sell
$msell  = Order::where('month', $month)->latest()->get()->sum(
    function($t){
        return $t->total - $t->discount;
    }
);
//monthly take due
$mtakedue = Due::where('month', $month)->latest()->get()->sum('pay_due');

//total expense and today expense
        $expense = Expense::latest()->get()->sum('amount');
        $texpense = Expense::where('check', $date)->sum('amount');

//total salary and today salary
        $salary = Salary::latest()->get()->sum('advance_pay');
        $tsalary = Salary::where('check', $date)->latest()->get()->sum('advance_pay');

//total take due and today 
        $takedue = Due::latest()->get()->sum('pay_due');
        $totakedue = Due::where('pay_date', $date)->latest()->get()->sum('pay_due');
//total order and today order        
        $orders = Order::latest()->get();
        $torders = Order::where('pay_date', $date)->latest()->get();

//total due and today due
        $tdue = Order::where('pay_date', $date)->latest()->get()->sum('due');
        $due = Order::latest()->get()->sum('due');

//total sell and Today sell
        $sell  = Order::latest()->get()->sum(
            function($t){
                return $t->total - $t->discount;
            }
        );
        $tsell  = Order::where('pay_date', $date)->latest()->get()->sum(
            function($t){
                return $t->total - $t->discount;
            }
        );

        return view('dashboard.index', compact('orders', 'torders', 'tsell', 'sell', 'due', 'tdue', 'takedue', 'totakedue', 'mtakedue', 'expense', 'texpense', 'salary', 'tsalary', 'msell', 'morders','mexpense', 'msalary', 'mdue'));
    }
}