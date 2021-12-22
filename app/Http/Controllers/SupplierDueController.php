<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\DueSupplier;
use Brian2694\Toastr\Facades\Toastr;

class SupplierDueController extends Controller
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

    public function person()
    {
        $suppliers = Supplier::latest()->get();
        return view('supdue.supdue', compact('suppliers'));   
    }

    public function SupduePay(Request $request)
    {
        $check = DueSupplier::where('pay_due', 0)->where('supplier_id', $request->supplier_id)->first();
        if ($check) {
            Toastr::error('Supplier pay due not availeable!');
            return back();
        }else{

            $supduepay = new DueSupplier;
            $supduepay->supplier_id = $request->supplier_id;
            $supduepay->pay_due = $request->pay_due;
            $supduepay->pay_date = $request->pay_date;
             $supduepay->save();

            Toastr::success('Supplier pay due successfully!');
            return back();
        }



    }

    public function SupPayShow($id)
    {

        $suppays = DueSupplier::where('supplier_id', $id)->orderBy('created_at', 'desc')->get();;
        return view('supdue.suppay', compact('suppays'));
    }

    public function edit($id)
    {
        $supedit = DueSupplier::findOrFail($id);
        return view('supdue.supedit', compact('supedit'));
    }

    public function update(Request $request, $id)
    {
        $supduepay = DueSupplier::findOrFail($id);
        $supduepay->supplier_id = $request->supplier_id;
        $supduepay->pay_due = $request->pay_due;
        $supduepay->pay_date = $request->pay_date;
        $supduepay->update();

        Toastr::success('Supplier pay due update successfully!');
        return redirect()->route('supdue');
    }
    
}
