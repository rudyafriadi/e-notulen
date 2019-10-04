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
<form method="POST" action="/datanotulen/update/{{$notulius->id}}" data-toggle="validator" enctype="multipart/form-data" role="form">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Edit Data Notulius</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$notulius->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{$notulius->nip}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Instansi</label>
            {{-- <input type="text" class="form-control" id="instansi" name="instansi" value="{{$notulius->instansi}}"> --}}
            <select name="instansi" class="form-control select @error('instansi') is-invalid @enderror" data-placeholder="Choose">
                    <@foreach ($instansi as $data)
                        <option value="{{ $data->nama_instansi }}">{{ $data->nama_instansi}}</option>
                    @endforeach
                </select>
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

