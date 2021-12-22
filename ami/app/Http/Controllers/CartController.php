<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Cart;
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

    public function store(Request $request, $id){
        $check = Cart::where('product_id', $id)->where('user_ip', request()->ip())->first();
        if ($check) {
            Cart::where('product_id', $id)->where('user_ip', request()->ip())->increment('weight');

            Toastr::success('Cart Product added successfully!');
            return back();
        }else{
            $cart = new Cart;
            $cart->product_id = $id;
            $cart->weight     = 1;
            $cart->user_ip    = request()->ip();
            $cart->created_at = Carbon::now();
            $cart->save();

            Toastr::success('Cart Product added successfully!');
            return back();
        }


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

        Toastr::error('Cart Product delete successfully!');
        return back();
    }


}