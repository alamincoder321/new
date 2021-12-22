<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Cart;
use App\Models\Customer;
use Carbon\Carbon;

class CartController extends Controller
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

    public function store(Request $request, $id)
    {
        $check = Cart::where('product_id', $id)->where('user_ip', request()->ip())->first();
        if ($check) {
            Cart::where('product_id', $id)->where('user_ip', request()->ip())->increment('weight');

            Toastr::success('Cart Product added successfully!');
        } else {
            $cart = new Cart;
            $cart->product_id = $id;
            $cart->weight     = 1;
            $cart->user_ip    = request()->ip();
            $cart->created_at = Carbon::now();
            $cart->save();

            Toastr::success('Cart Product added successfully!');
        }
        $carts     = Cart::where('user_ip', request()->ip())->latest()->get();
        $total = Cart::where('user_ip', request()->ip())->get()->sum(
            function ($t) {
                return $t->weight * $t->product->unit_cost;
            }
        );
        $customers = Customer::where('status', 1)->latest()->get();
        return view('pos.cart_body', compact('carts', 'total', 'customers'));
    }

    public function update(Request $request, $id)
    {
        Cart::where('id', $id)->where('user_ip', request()->ip())->update(['weight' => $request->weight]);

        Toastr::success('Cart Product update successfully!');
        return back();
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->where('user_ip', request()->ip())->delete();

        // Toastr::error('Cart Product delete successfully!');
        $carts     = Cart::where('user_ip', request()->ip())->latest()->get();
        $total = Cart::where('user_ip', request()->ip())->get()->sum(
            function ($t) {
                return $t->weight * $t->product->unit_cost;
            }
        );
        $customers = Customer::where('status', 1)->latest()->get();
        return view('pos.cart_body', compact('carts', 'total', 'customers'));
    }
}
