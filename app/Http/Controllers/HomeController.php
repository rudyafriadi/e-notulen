<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Category;
use App\Notulen;
use App\User;
use Carbon\Carbon;

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
        
        // $notulen = Notulen::all();
        // foreach ($notulen as $not) {
        //     $year = $not->created_at->format('Y');
        // }
        // $year = $notulen->tanggal;
        
        // dd($year);
        $instansi = Auth::user()->agency_id;
        // dd($instansi);
        $role = Auth::user()->role_id;

        $countnotulen = Notulen::where('agency_id',$instansi)->count();
        $countnotulen_rampung = Notulen::where('status','selesai')->where('agency_id',$instansi)->count();
        $countnotulen_pending = Notulen::where('status','pending')->where('agency_id',$instansi)->count();
        $countnotulius = User::where('agency_id',$instansi)->count();

        $kategori = Category::where('agency_id',$instansi)->get();

        $categories = [];
        $data = [];

        foreach ($kategori as $kat) {
            $notulen = Notulen::with('category')->where('agency_id',$instansi)->where('category_id',$kat->id)->get()->count();
            // dd($notulen);
            if($notulen != 0)
            {
                $categories[] = $kat->nama_kategori;
                $data[] = Notulen::with('category')->where('agency_id',$instansi)->where('category_id',$kat->id)->get()->count();
            }
        }
        
        // dd($data);
        return view('home', compact('countnotulen','countnotulius','countnotulen_rampung','countnotulen_pending','kategori','categories','data'));
    }
    
}
