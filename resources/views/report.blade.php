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
              <div class="input-group input-group-sm  ">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                      Filter
                    </button>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item"><button style="color:black" name="filter" id="filter" class="btn btn-warning btn-sm" type="button">Cari</button></li>
                    
                      {{-- <li class="dropdown-divider"></li> --}}
                      <li class="dropdown-item"><button style="color:black" class="btn btn-warning btn-sm" type="submit">Generate PDF</button></li>
                    
                    </ul>
                  </div>
                    <input type="text" class="form-control float-right" placeholder="Dari Tanggal" id="from_date"> 
                    &nbsp;
                    <input type="text" class="form-control float-right" placeholder="Sampai Tanggal" id="to_date">
                    &nbsp;
                    <button name="filter" id="filter" class="btn btn-warning btn-sm filter" type="button">Cari</button>


                  <div class="col-md-7">
                      
                  </div>
              </div>
        </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="order_table" class="table table-bordered table-striped">
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
        </tr>
        </thead>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
 
@endsection

<script>
  $(document).ready(function(){
    $('.input-daterange').datepicker({
      todayBtn:'linked',
      format:'yyyy-mm-dd',
      autoclose: true
    });

    load_data();

    function load_data(from_date = '', to_date = '')
    {
        $('#order_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url:'{{ route('laporan') }}',
              data: {from_date:from_date, to_date:to_date}
            },
            columns: [
              {
                  data:'id',
                  name:'id'
              },
              {
                  data:'tanggal',
                  name:'tanggal'
              },
              {
                  data:'created_at',
                  name:'created_at'
              },
              {
                  data:'agenda_rapat',
                  name:'agenda_rapat'
              },
              {
                  data:'j_rapat',
                  name:'j_rapat'
              },
              {
                  data:'users_id',
                  name:'users_id'
              },
              {
                  data:'status',
                  name:'status',
              },
              {
                  data:'file',
                  name:'file'
              }
            ]
        })
    }
      $(.filter).click(function(){
          // var from_date = $('#from_date').val();
          // var to_date = $('#to_date').val();
          // if(from_date != '' && to_date != '')
          // {
          //     $('#example1').DataTable().destroy();
          //     load_data(from_date, to_date);
          // }
          // else
          // {
          //     alert('Both data is required');
          // }
          alert('tesss');
      });
  });
    

   
</script>