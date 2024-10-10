<?php

namespace App\Http\Controllers;

use App\Mail\invoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class HomeController extends Controller
{
    function home(){
        $categories = Category::latest()->take(5)->get();
        $products = Product::where('product_show' , 1)->latest()->get();
        return view('TeeSpace.index',[
            'categories' => $categories,
            'products' => $products,
        ]);
    }
    function shop(){
        $categories = Category::all()->take(6);
        $products = Product::where('product_show', 1)->paginate(12);
        return view('TeeSpace.shop',[
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    function dashboard(){
        return view('backend.dashboard');        
    }

    function user_logout(){
        Auth::logout();
        return redirect('/');
    }
    function payment(){
        $cart = Cart::where('customer_id' , Auth::guard('customer')->id())->get();
        return view('TeeSpace.payment' ,[
            'cart' => $cart,
        ]);
    }
    function payment_method(Request $request){
        if ($request->payment == 2) {
            return redirect(url('stripe'));
        }
        elseif ($request->payment == 3) {
            return redirect(url('/pay'));
        }
         else {
            Order::where('order_id' , session('order_id'))->update([
                'payment' => 1,
                'updated_at' => Carbon::now(),
            ]);
            $product = OrderProduct::where('order_id' , session('order_id'))->get();
            foreach ($product as $product) {
                Inventory::where('product_id' , $product->product_id)->where('color_id' , $product->color_id)->where('size_id' , $product->size_id)->where('material_id' , $product->material_id)->decrement('quantity' , $product->quantity);
            }
            Mail::to(Billing::where('order_id', session('order_id'))->first()->email)->send(new invoiceMail(session('order_id')));
            return redirect(url('/order_placed'));
        }
    }
    function order_placed(){
        return view('TeeSpace.order_placed');
    }
}
