<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Image;
use File;
class SoftwareController extends Controller
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
        $settings = Setting::latest()->get();
        return view('setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.create');
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
            'title' => 'required'
        ]);

        if($request->hasFile('logo')) {

            $image = $request->file('logo');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(60,60)->save(public_path('images/logo/'.$filename));
            $img_url ="public/images/logo/".$filename;
        }

        if($request->hasFile('admin')) {

            $image = $request->file('admin');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(128,128)->save(public_path('images/admin/'.$filename));
            $img_url1 ="public/images/admin/".$filename;
        }

        $setting = new Setting;
        $setting->title = ucwords($request->title);
        $setting->logo = $img_url;
        $setting->admin = $img_url1;
        $setting->save();

        Toastr::success('Setting create Successfully!');
        return redirect()->route('setting.index');
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
        $setting = Setting::findOrFail($id);
        return view('setting.edit', compact('setting'));
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
            'title' => 'required'
        ]);

        $setting = Setting::findOrFail($id);
        $old     = $request->image;
        $old1    = $request->image1;


        if($request->hasFile('logo')) {
            if(File::exists($old)){
                File::delete($old);
            }
            $image = $request->file('logo');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(60,60)->save(public_path('images/logo/'.$filename));
            $img_url ="public/images/logo/".$filename;
        }

        if($request->hasFile('admin')) {
            if(File::exists($old1)){
                File::delete($old1);
            }
            $image = $request->file('admin');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(128,128)->save(public_path('images/admin/'.$filename));
            $img_url1 ="public/images/admin/".$filename;
        }

        $setting->title = ucwords($request->title);
        $setting->logo = $img_url;
        $setting->admin = $img_url1;
        $setting->update();

        Toastr::success('Setting create Successfully!');
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Setting::findOrFail($id);
        $old = $delete->logo;
        $old1 = $delete->admin;

        if ($delete) {
                
            if(File::exists($old)){
                File::delete($old);
            }
            if(File::exists($old1)){
                File::delete($old1);
            }
            $delete->delete();
            Toastr::success('Software setting Successfully delete');
            return back();
        }
    }
}
