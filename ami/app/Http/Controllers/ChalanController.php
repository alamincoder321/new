<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Chalan;
use App\Models\ChalanItem;

class ChalanController extends Controller
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

    public function create()
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
        return view('chalan.chalan', compact('products', 'categories', 'customers', 'carts', 'total'));
    }


    public function SaveChalan(Request $request)
    {

        $data               = new Chalan;
        $data->chalan_date  = $request->chalan_date;
        $data->total        = $request->total;
        $data->save();

        $chalan_id = $data->id;
        $products = Cart::all(); 
        foreach($products as $product){
            $orderitem               = new ChalanItem;
            $orderitem->chalan_id    = $chalan_id;
            $orderitem->product_id   = $product->product_id;
            $orderitem->name         = $product->product->name;
            $orderitem->weight       = $product->weight;
            $orderitem->unit_cost    = $product->product->unit_cost;
            $orderitem->save();
        }

        Cart::where('user_ip', request()->ip())->delete();

        Toastr::success('Chalan Confirm Added on Chalan table');
        return back();
    }

    public function index()
    {
        $chalans = Chalan::latest()->get();
        return view('chalan.index', compact('chalans'));
    }

    public function invoice($id)
    {
        $items = ChalanItem::where('chalan_id', $id)->latest()->get();
        $invoice = Chalan::findOrFail($id);
        
        return view('chalan.invoice', compact('invoice','items'));
    }
    
    public function destroy($id)
    {
        Chalan::findOrFail($id)->delete();
        Toastr::error('Chalan delete successfully!');
        return back();
    }
    
}
