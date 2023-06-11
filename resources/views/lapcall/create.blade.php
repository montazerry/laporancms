@section('js')
<script type="text/javascript">
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("debitur_nama").value = $(this).attr('data-debitur_nama');
                document.getElementById("rekening").value = $(this).attr('data-debitur_rekening');
                document.getElementById("debitur_id").value = $(this).attr('data-debitur_id');
                $('#myModal').modal('hide');
            });

            // $(document).on('click', '.pilih_anggota', function (e) {
            //     document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
            //     document.getElementById("anggota_nama").value = $(this).attr('data-anggota_nama');
            //     $('#myModal2').modal('hide');
            // });
          
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
            <form  method="POST" action="{{ route('lapcall.store') }}" >
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="username">username</label>
                  <select id="username" class="form-control" name="user_id">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="rekening">Rekening</label>
                  <input type="text" class="form-control" id="rekening" placeholder="No Rekening" name="rekening" required readonly="">

                </div>
                <div class="form-group">
                  <label for="debitur_nama">Nama Debitur</label>
                  <input type="text" class="form-control" id="debitur_nama" placeholder="Nama" required readonly="">
                  <input id="debitur_id" type="hidden" name="debitur_id" value="{{ old('debitur_id') }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Debitur</b> <span class="fa fa-search"></span></button>
                    </span>
                    @if ($errors->has('debitur_id'))
                    <span class="help-block">
                      <strong>{{ $errors->first('debitur_id') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('tanggal') ? ' has-error' : '' }}">
                  <label for="tanggal-laporan">Tanggal Laporan</label>
                  <input type="date" class="form-control" id="tanggal-laporan" name="tanggal" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              
              <div class="col-md-5">
                <div class="form-group">
                  <label for="riskcode">RiskCode</label>
                  <select id="riskcode" class="form-control" name="code_id">
                    @foreach($codes as $code)
                    <option value="{{$code->id}}">{{$code->riskcode}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group {{ $errors->has('tanggal_janji') ? ' has-error' : '' }}">
                  <label for="tanggaljanji">Tanggal Janji</label>
                  <input type="date" class="form-control" id="tanggaljanji" name="tanggal_janji" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}">
                </div>
                <div class="form-group {{ $errors->has('laporan') ? ' has-error' : '' }}">
                  <label for="keterangan">Keterangan</label>
                  <textarea  type="text" class="form-control" id="keterangan" rows="3" name="laporan"></textarea>
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



      <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>N0 Rekening</th>
                                    <th>Nama</th>
                                    <th>SPK</th>
                                    <th>Flafond</th>
                                    <th>Baki Debet</th>
                                    <th>Angsuran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($debiturs as $debitur)
                                <tr class="pilih" data-debitur_id="<?php echo $debitur->id; ?>" data-debitur_nama="<?php echo $debitur->nama; ?>" data-debitur_rekening="<?php echo $debitur->rekening; ?>" >
                                    <td>{{$debitur->rekening}}</td>
                                    <td>{{$debitur->nama}}</td>
                                    <td>{{$debitur->spk}}</td>
                                    <td>{{$debitur->flafond}}</td>
                                    <td>{{$debitur->outstanding}}</td>
                                    <td>{{$debitur->angsuran}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
@endsection