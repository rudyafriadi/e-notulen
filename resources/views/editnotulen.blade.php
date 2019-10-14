@extends('layouts.mainlayout')
@section('content')
<div class="card card-warning">
@if(session('sukses'))  
<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Data berhasil di edit
    </div>
@endif
<form method="POST" action="/datahasilnotulen/update/{{$notulen->id}}" data-toggle="validator" enctype="multipart/form-data" role="form">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Edit Hasil Notulen</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Agenda Rapat</label>
            <input type="text" class="form-control" id="agenda_rapat" name="agenda_rapat" value="{{$notulen->agenda_rapat}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Jenis Rapat</label>
            <input type="text" class="form-control" id="j_rapat" name="j_rapat" value="{{$notulen->category->nama_kategori}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Notulius</label>
            <input type="text" class="form-control" id="users_id" name="users_id" value="{{$notulen->user->name}}">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Rapat</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$notulen->tanggal}}">
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">Hari</label>
                <input type="text" class="form-control" id="hari" name="hari" value="{{$notulen->hari}}">
            </div>
        <div class="card-body">
            <div class="form-group">
                <input type="submit" value="Edit" class="btn btn-success float-right">
            </div>
        </div>
        
    </div>
</form>
<!-- /.card-body -->
</div>

@endsection

