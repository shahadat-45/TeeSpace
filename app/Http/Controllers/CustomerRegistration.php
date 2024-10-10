<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerRegistration extends Controller
{
    function customer_registration(){
        return view('TeeSpace.customer.registration');
    }
    function registration_store(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => 'required',
        ],
        [   
            'name.required'    => 'Name is required!',
            'email.required'      => 'Email is required!',
            'password.required' => 'Password is Required! ',
            'password_confirmation.required' => 'Confirm Password is Required! ',
        ]);

        Customer::insert([
            'full_name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect('/customer/login')->with('register_success' , 'Registered successfully');
    }
    function customer_login(){
        return view('TeeSpace.customer.login');
    }
    function customer_login_post(Request $request){
        if (Customer::where('email', $request->email)->exists()) {
           if (Auth::guard('customer')->attempt(['email'=>$request->email , 'password'=>$request->password])) {
            return redirect('/');
           }
           else {
               return back()->with('pass_error', 'Wrong password'); 
           }
        }
        else{
            return back()->with('email_error', 'Your Email is not exist');
        }

    }
    public function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/customer/login');
    }
}
