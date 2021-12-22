<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;

class PosController extends Controller
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

    public function index()
    {
        $total = Cart::where('user_ip', request()->ip())->get()->sum(
            function($t){
                return $t->weight * $t->product->unit_cost;
            }
        );

        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $customers = Customer::where('status', 1)->latest()->get();
        $carts     = Cart::where('user_ip', request()->ip())->latest()->get();
        return view('pos.newpos', compact('products', 'categories', 'customers', 'carts', 'total'));
    }

    public function Invoice(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
        ],[
            'customer_id.required' => 'Selected customer name first',
        ]);

        $total = Cart::where('user_ip', request()->ip())->get()->sum(
            function($t){
                return $t->weight * $t->product->unit_cost;
            }
        );

        if ($total) {
            $Tweight = Cart::where('user_ip', request()->ip())->get()->sum('weight');
            $customer = Customer::where('id', $request->customer_id)->first();
            $carts     = Cart::where('user_ip', request()->ip())->latest()->get();

            return view('pos.invoice', compact('customer', 'carts', 'total', 'Tweight'));
        }else{
            Toastr::error('Product select first!');
            return redirect()->route('pos');
        }
    }
}
