<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
   function add_to_cart(Request $request , $id){
      //   echo '<pre>';
      //   print_r($request->all());
      //   die;
        Cart::insert([
         'customer_id' => Auth::guard('customer')->id(),
         'product_id' => $id,
         'color_id' => $request->color,
         'size_id' => $request->size,
         'material_id' => $request->mtrl,
         'delivery' => $request->delivery,
         'quantity' => $request->quantity,
         'created_at' => Carbon::now(),
        ]);
        return back();
   }
   function cart(Request $request){
        $coupon = $request->coupon;
        $value = '';
        $amount = 0;
        $type = 0;
        if($coupon != ''){
           if ($coupon == Coupon::where('coupon_name' , $coupon)->exists()) {
              if (Coupon::where('coupon_name' , $coupon)->first()->validity < Carbon::now()) {
                 $value = 'Expired Coupon';
               }
               else{
                   $unique_id = Coupon::where('coupon_name', $coupon)->first()->unique_id;
                  if (OrderProduct::where('customer_id',Auth::guard('customer')->id())->where('coupon_code', $unique_id)->exists()) {
                     $value = 'Your Already Used This Coupon';
                  }
                  else{
                     $amount = Coupon::where('coupon_name' , $coupon)->first()->amount ; 
                     $type = Coupon::where('coupon_name' , $coupon)->first()->coupon_type ;
                     $coupon2 = Coupon::where('coupon_name' , $coupon)->first() ;
                     // session(['coupon' => ]);
                     Session::put('coupon', $coupon2);
                  }                    
                }
            }
            else{
               $value = 'Invalid Coupon';
            }
        }        
        session(['couponError' => $value]);
         $cart = Cart::where('customer_id' , Auth::guard('customer')->id())->get();
         return view('TeeSpace.cart' , [
            'cart' => $cart,
            'amount' => $amount,
            'type' => $type,
      ]);
   }
   function cart_delete($id){
      Cart::find($id)->delete();
      return back();
   }
   function cart_update(Request $request , $id){
      Cart::find($id)->update([
         'quantity' => $request->quantity,
         'updated_at' => Carbon::now(),
      ]);
      return back();
   }
}
