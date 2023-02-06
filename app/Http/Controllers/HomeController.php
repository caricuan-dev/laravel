<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user()
    {
        return view('layouts.user.index');
    }

    public function admin()
    {
        $users = Admin::permission('admin dashboard')->get();
        $all_users_with_all_their_roles = Admin::with('roles')->get();
      
        return view('layouts.admin.index');       
    }
}
