<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use File;
use Image;

class CompanyController extends Controller
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
        $companys = Company::latest()->get();
        return view('setting.company_index', compact('companys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.company_create');
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
            'title' => 'required',
            'address' => 'required',
            'phone'   => 'required',
            'company_logo' => 'required|mimes:png,jpg,jpeg,ico'
        ]);

        if($request->hasFile('company_logo')) {

            $image = $request->file('company_logo');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(60,60)->save(public_path('images/company/'.$filename));
            $img_url ="public/images/company/".$filename;
        }

        $company = new Company;
        $company->title = ucwords($request->title);
        $company->address = ucwords($request->address);
        $company->phone = $request->phone;
        $company->company_logo = $img_url; 
        $company->created_at = Carbon::now();
        $company->save();

        Toastr::success('Company details add successfully!');
        return redirect()->route('company.index'); 
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
        $company = Company::findOrFail($id);
        return view('setting.company_edit', compact('company'));
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
            'title' => 'required',
            'address' => 'required',
            'phone'   => 'required',
            'company_logo' => 'required|mimes:png,jpg,jpeg,ico'
        ]);

        $company = Company::findOrFail($id);
        $old     = $company->image;

        if($request->hasFile('company_logo')) {
            if(File::exists($old)){
                File::delete($old);
            }

            $image = $request->file('company_logo');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(60,60)->save(public_path('images/company/'.$filename));
            $img_url ="public/images/company/".$filename;
        }

        $company->title = ucwords($request->title);
        $company->address = ucwords($request->address);
        $company->phone = $request->phone;
        $company->company_logo = $img_url; 
        $company->updated_at = Carbon::now();
        $company->update();

        Toastr::success('Company details update successfully!');
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $old = $company->company_logo;

        if ($company) {
            if(File::exists($old)){
                File::delete($old);
            }

            $company->delete();
            Toastr::error('Company details delete successfully');
            return back(); 
        }
    }
}
