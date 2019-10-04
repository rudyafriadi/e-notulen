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
<form method="POST" action="/instansi/update/{{$instansi->id}}" data-toggle="validator" enctype="multipart/form-data" role="form">
    @csrf
    @method('POST')
    <div class="card-header">
        <h3 class="card-title">Edit Instansi</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Instansi</label>
            <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="{{$instansi->nama_instansi}}">
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

