<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function user_list(){
        $users = User::all();
        return view('backend.user.user_list',[
            'users' => $users,
        ]);
    }
}
