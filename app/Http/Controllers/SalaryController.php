<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Salary;
use Carbon\Carbon;

class SalaryController extends Controller
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
        $salarys = Salary::latest()->get();
        $employees = Employee::where('status', 1)->latest()->get();
        return view('salary.index', compact('salarys', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('status', 1)->latest()->get();
        return view('salary.create', compact('employees'));
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
            'employee_id'   => 'required',
            'advance_pay'   => 'required',
            'pay_date'      => 'required',
        ],[
            'employee_id.required' => 'Select Employee Name'
        ]);
        Salary::insert([
            'employee_id' => $request->employee_id,
            'advance_pay' => $request->advance_pay,
            'pay_date'    => $request->pay_date,
            'month'       => $request->month,
            'check'       => $request->check,   
            'created_at'  => Carbon::now()
        ]);
        Toastr::success('Salary added successfully!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salary::findOrFail($id)->delete();
        Toastr::error('Salary delete successfully!');
        return back();
    }
}
