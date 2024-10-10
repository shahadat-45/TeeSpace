<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    function checkout(){
        $cart = Cart::where('customer_id',Auth::guard('customer')->id())->get();
        $countries = Country::all();
        return view('TeeSpace.checkout',[
            'cart' => $cart,
            'countries' => $countries,
        ]);
    }
    function billing(Request $request ){
        // echo '<pre>';
        // print_r($request->all());
        // die;
        $order_id = uniqid();
        Billing::insert([
            'customer_id' => Auth::guard('customer')->id(),
            'order_id' => $order_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'company' => $request->company,
            'save_it' => $request->save_it ?? 0,
            'massage' => $request->massage,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);
        Order::insert([
            'customer_id' => Auth::guard('customer')->id(),
            'order_id' => $order_id,
            'charge' => $request->flexRadioDefault,
            'discount' => $request->discount,
            'total' => ($request->sub_total + $request->flexRadioDefault) - $request->discount,
            'created_at' => Carbon::now(),
        ]);
        $carts = Cart::where('customer_id' , Auth::guard('customer')->id())->get();
        foreach ($carts as $cart) {
            if ($cart->material_id == 0) {
                $price = Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->first();
                if($price->discount){
                    $after_discount = $price->price - (($price->price / 100) * $price->discount);
                }else{$after_discount = $price->price; }
            }else {
                $price = Inventory::where('product_id' , $cart->product_id)->where('color_id' , $cart->color_id)->where('size_id' , $cart->size_id)->where('material_id' , $cart->material_id)->first();
                if($price->discount){
                    $after_discount = $price->price - (($price->price / 100) * $price->discount);
                }else{$after_discount = $price->price; }
            }
            OrderProduct::insert([
                'customer_id' => Auth::guard('customer')->id(),
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'price' => $after_discount,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'material_id' => $cart->material_id,
                'quantity' => $cart->quantity,
                'coupon_code' => $request->coupon_code ?? Null,
                'created_at' => Carbon::now(),
            ]);
        }
        //Cart Delete
        // Cart::where('customer_id' , Auth::guard('customer')->id())->delete();
        Session::put('order_id', $order_id);
        return redirect()->route('payment');
    }
    function get_cities(Request $request){
        $str = '';
        $cities = City::where('country_id',$request->country_id)->get();
        foreach ($cities as $city) {
            $str .= '<option value=' . $city->id . '>'. $city->name .'</option>';
        }
        echo $str;
    }
}
