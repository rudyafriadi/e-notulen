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
      <h3 class="card-title">Data Hasil Notulen</h3> 
      <a type="button" class="float-right btn btn-success btn-sm" data-toggle="modal" data-target="#modal_form"><i class="fas fa-plus"></i>Tambah Data</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Rapat</th>
          <th>Tanggal Entri</th>
          <th>Agenda Rapat</th>
          <th>Jenis Rapat</th>
          <th>Notulius</th>
          <th>Status</th>
          <th>file</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; ?>
        @foreach ($notulens as $data)
        <tr>
          <td>{{$no}}</td>
          <td>{{$data->tanggal}}</td>
          <td>{{$data->created_at}}</td>
          <td>{{$data->agenda_rapat}}</td>
          <td>{{$data->category->nama_kategori}}</td>
          <td>{{$data->user->name}}</td>
          
          @if ($data->status=="selesai")  
            <td><span class="badge bg-success">Selesai</span></td>
          @else
            <td><span class="badge bg-danger">Pending</span></td>
          @endif

          @if ($data->file==null)
            <td><span class="badge bg-danger">File Belum di input</span></td>
          @else
            <td><a href="{{URL::to('/')}}/assets/file/{{$data->file}}" target="_blank">{{$data->file}}</a> </td>
          @endif
          <td>
            @if ($data->status==1)
              <a href="/datahasilnotulen/edit/{{$data->id}}" class="btn btn-warning btn-xs disabled"><i class="fas fa-edit"></i></a>
            @else
              <a href="/datahasilnotulen/edit/{{$data->id}}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
            @endif  
              <a href="/datahasilnotulen/view/{{$data->id}}" class="btn btn-info btn-xs"><i class="fas fa-eye"></i></a>
            
            @if (Auth::user()->role_id == 1)
              <a href="/datahasilnotulen/delete/{{$data->id}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
            @else
              <a href="/datahasilnotulen/delete/{{$data->id}}" class="btn btn-danger btn-xs disabled"><i class="fas fa-trash"></i></a>
            @endif
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
      <form method="POST" action="{{ url('datahasilnotulen/simpan') }}" data-toggle="validator" enctype="multipart/form-data" role="form">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Input Data Notulen</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="card-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <label for="exampleInputEmail1">Agenda Rapat</label>
                <input type="text" class="form-control" id="agenda_rapat" name="agenda_rapat" placeholder="Agenda Rapat" autofocus required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Rapat</label>
              <select name="category_id" class="form-control select2" data-placeholder="Choose">
                  <@foreach ($kategori as $data)
                      <option value="{{ $data->id}}">{{ $data->nama_kategori}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Instansi</label>
              <select name="agency_id" class="form-control select2" data-placeholder="Choose">
                  <@foreach ($instansi as $data)
                      <option value="{{ $data->id }}">{{ $data->nama_instansi}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Notulius</label>
                <select name="user_id" class="form-control select2" data-placeholder="Choose">
                    <@foreach ($usernotulen as $data)
                        <option value="{{ $data->id }}">{{ $data->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Rapat" autofocus required>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Hari</label>
              <input type="text" class="form-control" id="hari" name="hari" placeholder="Hari Pelaksanaan Rapat" autofocus required>
            </div>
            <div class="form-group">
              {{-- <label for="exampleInputEmail1">Status</label> --}}
              <input type="hidden" value="pending" class="form-control" id="status" name="status" placeholder="Status">
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
