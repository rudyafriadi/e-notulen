<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        return view ('login');
    }

    public function postsignin(Request $r){
        if (!\Auth::attempt(['username' => $r->username, 'password' => $r->password])){
            return redirect()->back();
        } 
        
        return redirect()->route('home');
        // dd(\Auth::attempt(['username' => $r->username, 'password' => $r->password]));
    }
}
