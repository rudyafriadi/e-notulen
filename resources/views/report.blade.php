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
      <div class="card-header input-daterange">
          {{-- <h3 class="card-title">Data Hasil Notulen</h3>  --}}
          <form method="get" action="{{ url('laporan/export-pdf') }}">
            @csrf
          <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                      Filter
                    </button>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item"><button style="color:black" name="filter" id="filter" class="btn btn-warning btn-sm" type="button">Cari</button></li>
                    
                      {{-- <li class="dropdown-divider"></li> --}}
                      <li class="dropdown-item"><button style="color:black" name="export_pdf" id="export_pdf" class="btn btn-warning btn-sm" type="submit">Generate PDF</button></li>
                    
                    </ul>
                  </div>
                    <input  type="text" class="form-control float-right" placeholder="Dari Tanggal" name="from_date" id="from_date" readonly> 
                    &nbsp;
                    <input  type="text" class="form-control float-right" placeholder="Sampai Tanggal" name="to_date" id="to_date" readonly>
                    &nbsp;
                    <button name="refresh" id="refresh" class="btn btn-warning btn-sm" type="submit">Refresh</button>


                  <div class="col-md-7">
                      
                  </div>
              </div>
            </form>    
        </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="order_table" class="table table-bordered table-striped">
        <thead>
        <tr>
          {{-- <th>No</th> --}}
          <th>Tanggal</th>
          <th>Agenda Rapat</th>
          <th>Jenis Rapat</th>
          <th>Notulius</th>
          <th>Status</th>
        </tr>
        </thead>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
 
@endsection