@extends('layouts.mainlayout')
@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v2</li>
          </ol> --}}
        </div><!-- /.col -->
      </div><!-- /.row -->
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-6">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-copy"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Notulen</span>
            <span class="info-box-number">
              {{$countnotulen}} 
              <small>Dokumen</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-6">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-copy"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Notulen Rampung</span>
              <span class="info-box-number">
                {{$countnotulen_rampung}} 
                <small>Dokumen</small>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-6">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>
    
              <div class="info-box-content">
                <span class="info-box-text">Notulen Pending</span>
                <span class="info-box-number">
                  {{$countnotulen_pending}} 
                  <small>Dokumen</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-6">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
      
                <div class="info-box-content">
                  <span class="info-box-text">Jumlah Notulius</span>
                  <span class="info-box-number">{{$countnotulius}}
                    <small>Orang</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Grafik Berdasarkan Jenis Rapat</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="chart">
                  <div id="NotulenChart" ></div>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
     
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
@endsection
@section('footer')
  {{-- <script src="{{asset('assets/bower_components/highcharts/highcharts.js')}}"></script> --}}
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script>
      Highcharts.chart('NotulenChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Rapat'
        },
        subtitle: {
            text: {!! json_encode(Auth::user()->agency->nama_instansi) !!}
        },
        xAxis: {
            categories: {!! json_encode($categories) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Dokumen)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Dokumen</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jenis Rapat',
            data: {!! json_encode($data) !!}

        }]
      });
  </script>
@endsection