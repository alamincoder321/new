<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Expense;
use Carbon\Carbon;

class expenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create');
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
            'short_desc'   => 'required',
            'amount'   => 'required',
            'date'      => 'required',
        ]);

        Expense::insert([
            'short_desc' => ucwords($request->short_desc),
            'amount' => $request->amount,
            'date'    => $request->date,
            'month'    => $request->month,
            'check'    => $request->check,
            'created_at'  => Carbon::now()
        ]);

        Toastr::success('Expense added successfully!');
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
        $expense = Expense::findOrFail($id);
        return view('expense.edit', compact('expense'));
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
            'short_desc'   => 'required',
            'amount'   => 'required',
            'date'      => 'required',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->short_desc = ucwords($request->short_desc);
        $expense->amount = $request->amount;
        $expense->date    = str_replace("-", ".", $request->date);
        $expense->month    = $request->month;
        $expense->check    = $request->check;
        $expense->updated_at  = Carbon::now();
        $expense->update();

        Toastr::success('Expense updated successfully!');
        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();
        Toastr::error('Expense delete successfully!');
        return back();
    }
}
