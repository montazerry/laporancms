@section('js')
 <script>
    $(document).ready(function () {

      fetch_laporan_data()

          function fetch_laporan_data(query = '') {
            $.ajax({
                url:"{{route('filter')}}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                  $('tbody').html(data.table_data);
                  $('#totaldata').text(data.total_data);
                }
            });
          }

      $(document).on('keyup','#search',function () {
          var query = $(this).val();
          fetch_laporan_data(query);
      });
      
    });
</script>
@stop
@extends('layouts.menu')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Dashboard</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              <div class="float-left">
                <p class="mb-0 text-left">Laporan</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-left mb-0">{{$lapcall->count()}}</h3>
                </div>
              </div>
            <p class="text-muted mt-3 mb-0">
              <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total seluruh Laporan
            </p>
          </div>
        </div>  
      </div>

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              <div class="float-left">
                <p class="mb-0 text-left">Laporan Janji Bayar</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-left mb-0">{{$lapcall->where('code_id','1')->count()}}</h3>
                </div>
              </div>
            <p class="text-muted mt-3 mb-0">
              <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Janji Bayar Debitur
            </p>
          </div>
        </div>  
      </div>

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              <div class="float-left">
                <p class="mb-0 text-left">Jumlah Debitur</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-left mb-0">{{$debitur->count()}}</h3>
                </div>
              </div>
            <p class="text-muted mt-3 mb-0">
              <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Debitur
            </p>
          </div>
        </div>  
      </div>

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              <div class="float-left">
                <p class="mb-0 text-left">Jumlah Debitur No Salah</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-left mb-0">{{$lapcall->where('code_id','4')->count()}}</h3>
                </div>
              </div>
            <p class="text-muted mt-3 mb-0">
              <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Debitur
            </p>
          </div>
        </div>  
      </div>

    </div>
    <!-- /.row -->
    <div class="row" style="margin-top: 20px;">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            User : {{Auth::user()->name}}</br>
            Bulan :{{ Carbon\carbon::now()->format('M') }}
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">No Rekening</th>
                    <th scope="col">Nama Debitur</th>
                    <th scope="col">SPK</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($lapcall as $lc)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <th>{{$lc->debitur['rekening']}}</th>
                    <th>{{$lc->debitur['nama']}}</th>
                    <td>{{$lc->debitur['spk']}}</td>
                    <td>{{$lc->code['riskcode']}}</td>
                    <td>{{$lc->tanggal}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /. row -->
  </div>
  <!-- /#page-wrapper -->
@endsection