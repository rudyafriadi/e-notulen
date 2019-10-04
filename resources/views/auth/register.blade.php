@extends('layouts.mainlayout')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Pegawai / Notulius</h3>
        <div>
            <button type="button" class="float-right btn btn-success btn-sm">Export PDF</button>
            <button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">Tambah Notulius</button>
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
                <td>{{$notulius->instansi}}</td>
                <td>{{$notulius->username}}</td>
                <td>
                  <a href="/datahasilnotulen/delete/" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                  <a href="/datahasilnotulen/edit/" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
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
            <form method="POST" action="{{ route('register') }}">
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
                <select name="instansi" class="form-control select @error('instansi') is-invalid @enderror" data-placeholder="Choose">
                    <@foreach ($data_agency as $data)
                        <option value="{{ $data->nama_instansi }}">{{ $data->nama_instansi}}</option>
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
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Re-Type Password" required autocomplete="new-password">

                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                    @error('password-confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="input-group mb-3">
                  <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role" placeholder="role" autofocus>

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
