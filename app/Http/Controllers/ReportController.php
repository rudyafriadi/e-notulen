<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notulen;
use DB;


class ReportController extends Controller
{
    public function index(Request $r)
    {
        if(request()->ajax())
        {
            if(!empty($r->from_date))
            {
                $data = DB::table('notulens')->whereBetween('tanggal', array($r->frome_date, $r->to_date))->get();
            }
            else
            {
                $data = DB::table('notulens')->get();
            }
            return datatables()->of($data)->make(true);
        }
        
        $instansi = Auth::user()->instansi;
        $role = Auth::user()->role;
        if ($role == 1) {
            $notulens = Notulen::all();
        } else {
            $notulens = Notulen::where('instansi', $instansi)->get();
        }
        return view ('report', compact ('notulens'));
    }

}
