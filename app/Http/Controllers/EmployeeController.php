<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Image;
use File;

class EmployeeController extends Controller
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
        $employees = Employee::latest()->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::where('status', 1)->latest()->get();
        return view('employee.create', compact('jobs'));
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
            'name'     => 'required',
            'phone'     => 'required|min:11|numeric',
            'city_name' => 'required',
            'upozila'   => 'required',
            'job_id'    => 'required',
            'join_date' => 'required',
            'image'     => 'required|mimes:png,jpg,jpeg'
        ],[
            'job_id.required' => 'Select your job title'
        ]);

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(200,200)->save(public_path('images/employee/'.$filename));
            $img_url ="public/images/employee/".$filename;
        }

        Employee::insert([
            'name'     => ucwords($request->name),
            'email'     => $request->email,
            'phone'     => $request->phone,
            'city_name' => ucwords($request->city_name),
            'upozila'   => ucwords($request->upozila),
            'job_id'    => $request->job_id,
            'join_date' => $request->join_date,
            'image'     => $img_url,
            'created_at'=> Carbon::now()
        ]);

        Toastr::success('Employee added successfully!');
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
        $employee = Employee::findOrFail($id);
        $jobs = Job::where('status', 1)->latest()->get();
        return view('employee.edit', compact('employee', 'jobs'));
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
            'name'     => 'required',
            'phone'     => 'required|min:11|numeric',
            'city_name' => 'required',
            'upozila'   => 'required',
            'job_id'    => 'required',
            'join_date' => 'required',
            'image'     => 'required|mimes:png,jpg,jpeg'
        ],[
            'job_id.required' => 'Select your job title'
        ]);

        $employee = Employee::findOrFail($id);
        $old      = $employee->image;
        if($request->hasFile('image')) {
            if (File::exists($old)) {
                File::delete($old);
            }

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(200,200)->save(public_path('images/employee/'.$filename));
            $img_url ="public/images/employee/".$filename;
        }

        $employee->name        = ucwords($request->name);
        $employee->email        = $request->email;
        $employee->phone        = $request->phone;
        $employee->city_name    = ucwords($request->city_name);
        $employee->upozila      = ucwords($request->upozila);
        $employee->job_id       = $request->job_id;
        $employee->join_date    = $request->join_date;
        $employee->image        = $img_url;
        $employee->updated_at   = Carbon::now();
        $employee->update();

        Toastr::success('Employee Updated successfully!');
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $old     = $employee->image;
        if ($employee) {
            if (File::exists($old)) {
                File::delete($old);
            }

            $employee->delete();
            Toastr::error('Employee delete successfully!');
            return back();
        }
    }

    //============== Employee active =========

    public function Active($id)
    {
        Employee::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Employee Active successfully!');
        return back();
    }

    //============== Employee inactive =========

    public function Inactive($id)
    {
        Employee::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Employee Inactive successfully!');
        return back();
    }
}
