<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TotalOrderController extends Controller
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

    public function TotalOrder()
    {
        $totals = Order::latest()->get();
        return view('dashboard.totalorder', compact('totals')); 
    }

    public function TodayOrder()
    {
        $date = date('d.m.Y');

        $todays = Order::where('pay_date', $date)->latest()->get();
        return view('dashboard.todayorder', compact('todays'));
    } 

    public function MonthOrder()
    {
        $month = date('m.Y');

        $months = Order::where('month', $month)->latest()->get();
        return view('dashboard.monthorder', compact('months'));
    } 
    
}
