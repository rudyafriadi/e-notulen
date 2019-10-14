@extends('layouts.mainlayout')
@section('content')
<div class="card card-secondary">
  @if(session('sukses'))  
  <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil di input
      </div>
      @endif
    <div class="card-header">
      <h3 class="card-title">Data Instansi</h3>
      <div><a type="button" class="btn btn-primary float-right btn-sm" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Generate PDF
      </a>
        <a type="button" class="float-right btn btn-success btn-sm" data-toggle="modal" data-target="#modal_form"><i class="fas fa-plus"></i>Tambah Data</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; ?>
        @foreach ($data_kategori as $data)
        <tr>
          <td>{{$no}}</td>
          <td>{{$data->nama_kategori}}</td>
          
          <td>
                <a href="/kategori/edit/{{$data->id}}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                <a href="/kategori/delete/{{$data->id}}" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        <?php $no++; ?>
        @endforeach
        
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <div class="modal fade" id="modal_form" tab-index="-1" role="dialog" aria-hidden="true" data-bcakdrop="static">
    <div class="modal-dialog">
      <div class="modal-content bg-secondary" >
      <form method="POST" action="{{ url('kategori/simpan') }}" data-toggle="validator" enctype="multipart/form-data" role="form">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Input Kategori Rapat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="card-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori" autofocus required>
            </div>
            <div class="form-group">
                    <label for="exampleInputEmail1">Instansi</label>
                    <select name="agency_id" class="form-control select2" data-placeholder="Choose">
                        <@foreach ($data_agency as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_instansi}}</option>
                        @endforeach
                    </select>
                  </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-light">Simpan</button>
        </div> 
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection