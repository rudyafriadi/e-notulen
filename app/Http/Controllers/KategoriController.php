<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Agency;

class KategoriController extends Controller
{
    public function index()
    {
        $instansi = Auth::user()->agency_id;
        $role = Auth::user()->role_id;
        if($role == 1){
            $data_kategori = Category::all();
            $data_agency = Agency::all();
        } else {
            $data_kategori = Category::where('agency_id', $instansi)->get();
            $data_agency = Agency::where('id', $instansi)->get();
        }
        // $data_notulius = User::where('instansi', $instansi)->get();
        
        return view ('kategorirapat', compact('data_kategori','data_agency'));
    }

    public function save(Request $r){
        $kategori = new Category;
        $kategori->nama_kategori = $r->input('nama_kategori');
        $kategori->agency_id = $r->input('agency_id');

        $kategori->save();
        return redirect()->route('kategori')->with('sukses','Data berhasil diinput');
    }

    public function edit($id){
        $kategori = Category::find($id);
        return view('editkategori',['kategori' => $kategori]);
    }

    public function update(Request $request, $id){
        $kategori = Category::find($id);
        $kategori->update($request->all());
        return redirect('kategori')->with('sukses','Data berhasil diedit');
    }

    public function delete($id){
        $kategori = Agency::find($id);
        $kategori->delete();
        return redirect()->route('kategori');
    }

}
