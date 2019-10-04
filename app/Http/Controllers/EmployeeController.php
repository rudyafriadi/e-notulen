<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;

class EmployeeController extends Controller
{
    public function index()
    {
        // $usernotulen = User::all();
        $u['pegawai'] = Employe::orderby('id', 'DESC')->get();
        // $d['notulens'] = Notulen::orderby('id', 'DESC')->get();
        return view('datahasilnotulen', $u);
    }

    public function save(Request $r){
        $notulen = new Notulen;
        $notulen->agenda_rapat = $r->input('agenda_rapat');
        $notulen->j_rapat = $r->input('j_rapat');
        $notulen->users_id = $r->input('users_id');
        $notulen->status = $r->input('status');
        $notulen->tanggal = $r->input('tanggal');
        $notulen->hari = $r->input('hari');
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

    public function delete($id){
        $notulen = Notulen::find($id);
        $notulen->delete();
        return redirect()->route('datanotulen');
    }

}
