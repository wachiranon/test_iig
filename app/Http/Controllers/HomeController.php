<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Session::get('user');
        // dd($_COOKIE);
        $user = json_decode($_COOKIE['user']);
        if($user == null){
            return redirect()->route('login')->with('user',$user);
        }
        return view('edit_profile',compact('user'));
    }

    public function login()
    {
        setcookie('user', null,-1);
        
        return view('auth.login');
        // return redirect()->route('home')->with('user',$user);
    }
}
