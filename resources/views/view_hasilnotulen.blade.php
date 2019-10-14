@extends('layouts.mainlayout')
@section('content')
<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Detail Hasil Notulen</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Agenda Rapat</th>
                  <td>:</td>
                  <td>{{$viewnotulen->agenda_rapat}}</td>
                </tr>
                <tr>
                    <th>Jenis Rapat</th>
                    <td>:</td>
                    <td>{{$viewnotulen->category->nama_kategori}}</td>
                </tr>
                <tr>
                    <th>Notulius</th>
                    <td>:</td>
                    <td>{{$viewnotulen->user->name}}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{$viewnotulen->tanggal}}</td>
                </tr>
                <tr>
                    <th>Hari</th>
                    <td>:</td>
                    <td>{{$viewnotulen->hari}}</td>
                </tr>
              </table>
            </div>
          </div>
    </div>
<!-- /.card-body -->
</div>

<form method="POST" action="/datahasilnotulen/insertfile/{{$viewnotulen->id}}" data-toggle="validator" enctype="multipart/form-data" role="form">
@csrf
@method('PUT')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Input File Notulen</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    </div>
    </div>
    <input type="hidden" id="status" name="status" value="selesai">
    <div class="card-body">
        <div class="form-group">
            <input type="file" name="file" id="inputName" class="form-control" value="AdminLTE" >
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <input type="submit" value="Kirim" class="btn btn-success float-right">
        </div>
    </div>
</div>
</form>
@endsection

