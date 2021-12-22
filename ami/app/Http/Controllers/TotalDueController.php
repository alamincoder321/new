<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Salary;

class TotalDueController extends Controller
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

    public function TotalDue()
    {
        $totals = Customer::latest()->get();
        return view('dashboard.totaldue.totaldue', compact('totals')); 
    }


    public function TotalExpense()
    {
       $expenses = Expense::latest()->get();
       $salarys = Salary::latest()->get();
       return view('dashboard.expense.totalexpense', compact('expenses', 'salarys'));
    }
}
