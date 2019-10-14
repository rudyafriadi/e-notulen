@extends('layouts.mainlayout')
@section('content')
<div class="card">
    @if(session('sukses'))  
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      Data berhasil di input
    </div>
    {{-- @else
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      Data tidak bisa di input
    </div>   --}}
    @endif
    <div class="card-header">
      <h3 class="card-title">Data Pegawai / Notulius</h3>
        <div>
            <button type="button" class="float-right btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default">Tambah Notulius</button>
        </div>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nama</th>
          <th>NIP/NIPTT</th>
          <th>Instansi</th>
          <th>Username</th>
          <th>Aksi</th>
          {{-- <th>No HP</th>
          <th>Jenis Kelamin</th> --}}
        </tr>
        </thead>
        <tbody>
            @foreach ($data_notulius as $notulius)
              <tr>
                <td>{{$notulius->name}}</td>
                <td>{{$notulius->nip}}</td>
                <td>{{$notulius->agency->nama_instansi}}</td>
                <td>{{$notulius->username}}</td>
                <td>
                  <a href="/datahasilnotulen/delete/{{$notulius->id}}" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                  <a href="/datanotulen/edit/{{$notulius->id}}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
            @endforeach
      </table>
    </div>
  </div>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Notulius</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('daftar') }}">
                @csrf
              <div class="input-group mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama" autofocus>

                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
              </div>

            <div class="input-group mb-3">
                <input id="name" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" autocomplete="nip" placeholder="NIP" autofocus>

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
            </div>

            <div class="input-group mb-3">
                {{-- <input id="name" type="text" class="form-control @error('instansi') is-invalid @enderror" name="instansi" value="{{ old('instansi') }}" required autocomplete="instansi" placeholder="Instansi" autofocus> --}}
                <select name="agency_id" class="form-control select @error('agency_id') is-invalid @enderror" data-placeholder="Choose">
                    <@foreach ($data_agency as $data)
                        <option value="{{ $data->id }}">{{ $data->nama_instansi}}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
          </div>
              
          <div class="input-group mb-3">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="username">

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password" required autocomplete="new-password">

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div class="input-group mb-3">
                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Re-Type Password" required autocomplete="new-password">

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password-confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div class="input-group mb-3">
              {{-- <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role" placeholder="role" autofocus> --}}
              
              @if ( $notulius->role_id == 1 )
                  <select name="role_id" class="form-control select @error('role_id') is-invalid @enderror" data-placeholder="Choose">
                      <@foreach ($data_role as $data)
                          <option value="{{ $data->id }}">{{ $data->nama_role}}</option>
                      @endforeach
                  </select>
              @else
                  <select name="role_id" class="form-control select @error('role_id') is-invalid @enderror" data-placeholder="Choose">
                      <option value="2">Admin</option>
                  </select>
              @endif

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-8">
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection

