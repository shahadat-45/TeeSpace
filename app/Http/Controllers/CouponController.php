<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon(){
        $coupon = Coupon::all();
        return view('backend.coupon.coupon',[
            'coupons' => $coupon,
        ]);
    }
    function coupon_store(Request $request){
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_type' => $request->coupon_type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'unique_id' => $request->coupon_type . uniqid() . $request->amount . $request->validity,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success' , 'Coupon added successfully');
    }
    function coupon_delete($id){
        Coupon::find($id)->delete();
        return back()->with('cpn_dlt' , 'Coupon deleted successfully');
    }
}
