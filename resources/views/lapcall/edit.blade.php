@section('js')
<script type="text/javascript">
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("debitur_nama").value = $(this).attr('data-debitur_nama');
                document.getElementById("rekening").value = $(this).attr('data-debitur_rekening');
                document.getElementById("debitur_id").value = $(this).attr('data-debitur_id');
                $('#myModal').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

</script>
@stop
@extends('layouts.menu')

@section('content')
    <div id="page-wrapper">
        <div class="row">
          <div class="col">
            <h3 class="page-header">Input Data Laporan</h3>
          </div>
        </div>

        @if (session('status'))
        <div class="row mt-3 ml-1">
           <div class="alert alert-success col-lg-10">
              {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
           </div>
        </div>
        @endif

        <div class="row ">
          <div class="col-md-12">
            <form  method="POST" action="{{ route('lapcall.update',$data->id) }}" >
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="name">Username</label>
                  <input type="hidden" class="form-control" id="name" placeholder="No name" name="user_id" required readonly="" value="{{ $data->user->id }}">
                  <input type="text" class="form-control" id="name" placeholder="No name" name="nama" required readonly="" value="{{ $data->user->name }}">
                </div>
                <div class="form-group">
                  <label for="rekening">Rekening</label>
                  <input type="text" class="form-control" id="rekening" placeholder="No Rekening" nama="rekening" required readonly="" value="{{ $data->debitur->rekening }}">
                </div>
                <div class="form-group">
                  <label for="debitur_nama">Nama Debitur</label>
                  <input type="text" class="form-control" id="debitur_nama" placeholder="Nama" required readonly="" value="{{ $data->debitur->nama }}">
                  <input id="debitur_id" type="hidden" name="debitur_id" value="{{ $data->debitur->id }}" required readonly="">
                </div>
                <div class="form-group {{ $errors->has('tanggal') ? ' has-error' : '' }}">
                  <label for="tanggal-laporan">Tanggal Laporan</label>
                  <input type="date" class="form-control" id="tanggal-laporan" name="tanggal" value="{{ $data->tanggal }}">
                  @if ($errors->has('tanggal'))
                    <span class="help-block">
                      <strong>{{ $errors->first('tanggal') }}</strong>
                    </span>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              
              <div class="col-md-5">
                <div class="form-group">
                  <label for="riskcode">RiskCode</label>
                  <select id="riskcode" class="form-control" name="code_id">
                    @foreach($codes as $code)
                    <!-- pengkondisian untuk memilih optionn berdasarkan query yang sebelumnya -->
                      <option value="{{ $code->id}}"  @if($code->id==$data->code->id) selected='selected' @endif >{{$code->riskcode}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group {{ $errors->has('tanggal_janji') ? ' has-error' : '' }}">
                  <label for="tanggaljanji">Tanggal Janji</label>
                  <input type="date" class="form-control" id="tanggaljanji" name="tanggal_janji" value="{{ $data->tanggal_janji }}">
                </div>
                <div class="form-group {{ $errors->has('laporan') ? ' has-error' : '' }}">
                  <label for="keterangan">Keterangan</label>
                  <textarea  type="text" class="form-control" id="keterangan" rows="3" name="laporan" >{{ $data->laporan }}</textarea>
                  @if ($errors->has('laporan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('laporan') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              
            </div>
            </form>
          </div>
        </div>
    </div>



@endsection