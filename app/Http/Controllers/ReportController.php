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
        
        $instansi = Auth::user()->agency_id;
        $role = Auth::user()->role_id;
        // $data = Notulen::with(['agency'])->whereBetween('tanggal', array($request->from_date, $request->to_date))->where('agency_id', $instansi)->get();
        // $data = Notulen::with(['agency'])->where('agency_id', $instansi) ->orderBy('created_at', 'DESC')->get();
        // dd($data);

        if ($role == 1) {
            if(request()->ajax())
            {
                if(!empty($request->from_date))
                    {
                        $data = Notulen::with(['category','user'])->whereBetween('tanggal', array($request->from_date, $request->to_date))->get();
                        // return datatables()->of($data)->make(true);
                    }
                    else
                    {
                        $data = Notulen::with(['category','user'])->get();
                    }
                    
                return datatables()->of($data)->make(true);
            }

        } else {

            if(request()->ajax())
            {
                if(!empty($request->from_date))
                    {
                        $data = Notulen::with(['category','user'])->whereBetween('tanggal', array($request->from_date, $request->to_date))->where('agency_id', $instansi)->get();
                    }
                    else
                    {
                        $data = Notulen::with(['category','user'])->where('agency_id', $instansi)->orderBy('created_at', 'DESC')->get();
                    }
                return datatables()->of($data)->make(true); 
            }
        }
        return view ('report');
    }

    public function json()
    {
        $instansi = Auth::user()->agency_id;
        // return datatables()->of(Notulen::with(['agency'])->where('agency_id', $instansi)->orderBy('created_at', 'DESC')->get()) ->make(true); 

        $data = Notulen::with(['category','user'])->where('agency_id', $instansi)->orderBy('created_at', 'DESC')->get();

                // $kategori = [];
                // foreach ($data as $dt) {
                //     $kategori = $dt;
                // }
                dd(json_encode($data));
    }

    public function exportPDF(Request $request)
    {
        $instansi = Auth::user()->agency_id;
        $role = Auth::user()->role_id;
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $data = Notulen::whereBetween('tanggal', array($from_date, $to_date))->where('agency_id', $instansi)->get();
        // $notulen = Notulen::groupBy('instansi','$instansi')->get();
        $pdf = PDF::loadView('export.ExportNotulen', compact('data','from_date','to_date','instansi'));
        return $pdf->download('Laporan_notulen_'.date('Y-m-d_H-i-s').'.pdf');
    }

}
