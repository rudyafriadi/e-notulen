<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countnotulen = DB::table('notulens')->count();
        $countnotulen_rampung = DB::table('notulens')->where('status','selesai')->count();
        $countnotulen_pending = DB::table('notulens')->where('status','pending')->count();
        $countnotulius = DB::table('users')->count();
        return view('home', compact('countnotulen','countnotulius','countnotulen_pending','countnotulen_rampung'));
    }
    
}
