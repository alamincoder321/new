<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class JobController extends Controller
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
        $jobs = Job::latest()->get();
        return view('job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job.create');
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
            'title'     => 'required',
            'salary'    => 'required'
        ]);

        $job = Job::insert([
            'title' => ucwords($request->title),
            'salary' => $request->salary,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Job added successfully!');
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
        $job = Job::findOrFail($id);
        return view('job.edit',compact('job'));
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
            'title'     => 'required',
            'salary'    => 'required'
        ]);

        $job = Job::findOrFail($id);
        $job->title = ucwords($request->title);
        $job->salary = $request->salary;
        $job->updated_at = Carbon::now();
        $job->update(); 

        Toastr::success('Job update successfully!');
        return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job::findOrFail($id)->delete();
        Toastr::error('Job Delete successfully!');
        return back();
    }

        //============== Job active =========

        public function Active($id)
        {
            Job::findOrFail($id)->update(['status' => 1]);
            Toastr::success('Job Active successfully!');
            return back();
        }
    
        //============== Job inactive =========
    
        public function Inactive($id)
        {
            Job::findOrFail($id)->update(['status' => 0]);
            Toastr::error('Job Inactive successfully!');
            return back();
        }
}
