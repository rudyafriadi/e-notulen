<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Notulen;
use DB;
use PDF;
// use Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $instansi = Auth::user()->instansi;
        $role = Auth::user()->role;
        if ($role == 1) {
            if(request()->ajax())
            {
                if(!empty($request->from_date))
                    {
                        $data = DB::table('notulens')->whereBetween('tanggal', array($request->from_date, $request->to_date))->get();
                        
                        // return datatables()->of($data)->make(true);
                    }
                    else
                    {
                        $data = DB::table('notulens')->get();
                    }
                    
                return datatables()->of($data)->make(true);
            }
        } else {
            if(request()->ajax())
            {
                if(!empty($request->from_date))
                {
                    $data = DB::table('notulens')->whereBetween('tanggal', array($request->from_date, $request->to_date))->where('instansi', $instansi)->get();
                    
                }
                else
                {
                    $data = DB::table('notulens')->where('instansi', $instansi)->get();
                }
                return datatables()->of($data)->make(true);
            }
        }
        return view ('report');
    }

    public function exportPDF(Request $request)
    {
        $instansi = Auth::user()->instansi;
        $role = Auth::user()->role;
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $data = DB::table('notulens')->whereBetween('tanggal', array($from_date, $to_date))->where('instansi', $instansi)->get();
        // $notulen = Notulen::groupBy('instansi','$instansi')->get();
        $pdf = PDF::loadView('export.ExportNotulen', compact('data','from_date','to_date','instansi'));
        return $pdf->download('Laporan_notulen_'.date('Y-m-d_H-i-s').'.pdf');
    }

}
