<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notulen;
use App\User;
use App\agency;
use PDF;

class DatanotulenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        // $usernotulen = User::all();
        // $u['usernotulen'] = User::orderby('id', 'DESC')->get();
        // $d['notulens'] = Notulen::orderby('id', 'DESC')->get();
        // $a['instansi'] = agency::orderby('id', 'DESC')->get();
        // return view('datahasilnotulen', $d, $u, $a);

        $instansi = Auth::user()->instansi;
        $role = Auth::user()->role;
        if($role == 1){
            if ($r->has('cari')) {
                $notulens = Notulen::where('tahun','LIKE','%'.$r->cari.'%')->get();
            } else {
                $notulens = Notulen::all();
            }
            $usernotulen = User::all();
            $instansi = Agency::all();
        } else {
            if ($r->has('cari')) {
                $notulens = Notulen::where('tahun','LIKE','%'.$r->cari.'%')->get();
            } else {
                $notulens = Notulen::where('instansi', $instansi)->get();
            }
            $usernotulen = User::all();
            $instansi = Agency::where('nama_instansi', $instansi)->get();
                
        }
        return view ('datahasilnotulen', compact ('notulens','usernotulen','instansi'));
    }

    public function exportPDF(Request $tahun)
    {
            if ($tahun->has('cari')){
                $notulen = Notulen::where('tahun','LIKE','%'.$tahun->cari.'%')->get();
                $pdf = PDF::loadView('export.ExportNotulen', compact('notulen'));
                return $pdf->download('Laporan_notulen_'.date('Y-m-d_H-i-s').'.pdf');
            }
            
        
    }


    public function save(Request $r){
        $notulen = new Notulen;
        $notulen->agenda_rapat = $r->input('agenda_rapat');
        $notulen->j_rapat = $r->input('j_rapat');
        $notulen->instansi = $r->input('instansi');
        $notulen->users_id = $r->input('users_id');
        $notulen->tanggal = $r->input('tanggal');
        $notulen->hari = $r->input('hari');
        $notulen->status = $r->input('status');
        // $file = $r->file('file');
        // $notulen->file = $file   getClientOriginalName();
        // $file->move(public_path('assets/file/'),$file->getClientOriginalName());

        $notulen->save();
        return redirect()->route('datanotulen')->with('sukses','Data berhasil diinput');
    }

    public function edit($id){
        $notulen = Notulen::find($id);
        return view('editnotulen',['notulen' => $notulen]);
        
    }

    public function update(Request $request, $id){
        $notulen = Notulen::find($id);
        $notulen->update($request->all());
        return redirect('/datahasilnotulen')->with('sukses','Data berhasil diedit');
        
    }

    public function view($id){
        // return view('view_hasilnotulen');
        $viewnotulen = Notulen::find($id);
        return view('view_hasilnotulen',['viewnotulen' => $viewnotulen]);
    }

    public function insertfile(Request $r, $id){
        $viewnotulen = Notulen::find($id);
        
        $viewnotulen->status = $r->input('status');
        
        if ($r->hasfile('file')){
            $file = $r->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/file/', $filename));
            $viewnotulen->file = $filename;
        }
        
        // $viewnotulen->file = $file->getClientOriginalName();
        // $file->move(public_path('assets/file/'),$file->getClientOriginalName());

        $viewnotulen->save();
        return redirect('/datahasilnotulen')->with('sukses','Data berhasil diedit');
    }
    
    public function delete($id){
        $notulen = Notulen::find($id);
        $notulen->delete();
        return redirect()->route('datanotulen');
    }

    // public function exportPDF()
    // {
    //     $notulen = Notulen::where('tahun','2018')->get();
    //     $pdf = PDF::loadView('export.ExportNotulen', compact('notulen'));
    //     return $pdf->download('Laporan_notulen_'.date('Y-m-d_H-i-s').'.pdf');
    // }

}
