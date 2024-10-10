<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    function customer_profile(){
        $data = Customer::find(Auth::guard('customer')->id());
        $myorder = Order::where('customer_id', Auth::guard('customer')->id())->get();
        return view('TeeSpace.customer.myorder',[
            'data' => $data,
            'myorders' => $myorder, 
        ]);
    }
    function customer_profile_edit(){
        $data = Customer::find(Auth::guard('customer')->id());
        $country = Country::all();
        return view('TeeSpace.customer.update_profile',[
            'data' => $data,
            'country' => $country,
        ]);
    }
    function customer_profile_update(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // die;
        if ($request->profile_image) {
            $customer = Customer::find(Auth::guard('customer')->id());
            if ($customer->photo) {
                $profile_img = public_path('customer/' . $customer->photo);
                unlink($profile_img );
            }
            $photo = $request->profile_image;
            $ext = $photo->extension();
            $file_name = Str::lower(str_replace(' ', '-', $request->name)) . '-' . now()->format('d-m-Y') . '.' . $ext;
            Image::make($photo)->save(public_path('customer/' . $file_name));
            Customer::find(Auth::guard('customer')->id())->update([
                'full_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'bio' => $request->bio,
                'photo' => $file_name,
                'country' => $request->country,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            Customer::find(Auth::guard('customer')->id())->update([
                'full_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'bio' => $request->bio,
                'country' => $request->country,
                'updated_at' => Carbon::now(),
            ]);
        }
        
        if ($request->old_password && $request->password && $request->password_confirmation) {
            if(password_verify($request->password, Customer::find(Auth::guard('customer')->id())->password )){
                if($request->password == $request->password_confirmation){
                    Customer::find(Auth::guard('customer')->id())->update([
                        'password' => bcrypt($request->password),
                        'updated_at' => Carbon::now(),
                    ]); 
                }
                else{
                    return back()->with('pass_match' , 'Password & Confirm Password Are Not Match');
                }
            }
            else{
                return back()->with('pass_wrong' , 'Old Password Is Wrong');
            }
        }
        
        return back()->with('success' , 'Profile Information Updated Successfully');
    }
}
