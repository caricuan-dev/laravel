<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('layouts.admin.login');
    }

    public function check(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:3|max:30'
         ],[
             'email.exists'=>'This email is not exists in admins table'
         ]);

         $creds = $request->only('email','password');

         if( Auth::guard('admin')->attempt($creds) ){
             return redirect()->route('admin.dashboard');
         }else{
             return redirect()->route('admin.login')->with('fail','Incorrect credentials');
         }
    }
}
