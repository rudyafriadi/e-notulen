<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agency;
use PDF;

class AgencyController extends Controller
{
    public function index()
    {
        $instansi = Agency::all();
        return view ('instansi',['instansi' => $instansi]);
        // return view ('surat.tables.instansi_table',['data_instansi' => $data_instansi]);
    }

    public function save(Request $r){
        $instansi = new Agency;
        $instansi->nama_instansi = $r->input('nama_instansi');

        $instansi->save();
        return redirect()->route('instansi')->with('sukses','Data berhasil diinput');
    }

    public function edit($id){
        $instansi = Agency::find($id);
        return view('editinstansi',['instansi' => $instansi]);
    }

    public function update(Request $request, $id){
        $instansi = Agency::find($id);
        $instansi->update($request->all());
        return redirect('instansi')->with('sukses','Data berhasil diedit');
    }

    public function delete($id){
        $instansi = Agency::find($id);
        $instansi->delete();
        return redirect()->route('instansi');
    }

    public function exportPDF()
    {
        $instansi = Agency::get();
        $pdf = PDF::loadView('export.ExportInstansi', compact('instansi'));
        return $pdf->download('Laporan_notulen_'.date('Y-m-d_H-i-s').'.pdf');
    }
}
