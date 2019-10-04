<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Agency;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotulenController extends Controller
{
    public function index()
    {
        $instansi = Auth::user()->instansi;
        $role = Auth::user()->role;
        if($role == 1){
            $data_notulius = User::all();
            $data_agency = Agency::all();
        } else {
            $data_notulius = User::where('instansi', $instansi)->get();
            $data_agency = Agency::where('nama_instansi', $instansi)->get();
        }
        // $data_notulius = User::where('instansi', $instansi)->get();
        
        return view ('datanotulen',['data_notulius' => $data_notulius], ['data_agency' => $data_agency]);
        // return view ('surat.tables.instansi_table',['data_instansi' => $data_instansi]);
    }

    public function postRegister(Request $r){
        $this->validate($r, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        User::create([
            'name' => $r->name,
            'nip' => $r->nip,
            'instansi' => $r->instansi,
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'role' => $r->role,
        ]);
        return redirect()->route('notulen')->with('sukses','Data berhasil diinput');
    }

    // public function save(Request $r){
    //     $notulius = new notulius;
    //     $notulius->users_id = $r->input('users_id');
    //     $notulius->nama = $r->input('nama');
    //     $notulius->nip = $r->input('nip');
    //     $notulius->telp = $r->input('telp');
    //     $notulius->jenis_kelamin = $r->input('jenis_kelamin');
    //     $notulius->alamat = $r->input('alamat');
    //     $notulius->role = $r->input('role');

    //     $notulen->save();
    //     return redirect()->route('notulen')->with('sukses','Data berhasil diinput');
    // }

    public function edit($id){
        $notulius = User::find($id);
        $instansi = Agency::all();
        return view('editnotulius',['notulius' => $notulius],['instansi' => $instansi]);
    }

    public function update(Request $request, $id){
        $notulius = User::find($id);
        $notulius->update($request->all());
        return redirect('/datanotulen')->with('sukses','Data berhasil diedit');
    }

    public function delete($id){
        $notulius = User::find($id);
        $notulius->delete();
        return redirect()->route('datanotulen');
    }
}
