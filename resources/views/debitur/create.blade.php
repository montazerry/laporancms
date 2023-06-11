@section('js')

@stop
@extends('layouts.menu')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col">
        <h3 class="page-header">Input Data Debitur</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-10">
        <form method="post" action="{{route('debitur.store')}}"> 
        {{ csrf_field() }}
        {{ method_field('post') }}
          <div class="form-group row" >
            <label for="rekening" class="col-sm-2 col-form-label">No Rekening</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="rekening" name="rekening">
              @error('rekening')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="spk" class="col-sm-2 col-form-label">No SPK</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="spk" name="spk">
              @error('spk')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="nama" class="col-sm-2 col-form-label" >Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama">
              @error('nama')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row" {{ $errors->has('flafond') ? ' has-error' : '' }}>
            <label for="flafond" class="col-sm-2 col-form-label">Flafond</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="flafond" name="flafond">
            </div>
          </div>
          <div class="form-group row" {{ $errors->has('oustanding') ? ' has-error' : '' }}>
            <label for="outstanding" class="col-sm-2 col-form-label">Outstanding</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="outstanding" name="outstanding">
            </div>
          </div>
          <div class="form-group row"> 
            <label for="tunggakanbln" class="col-sm-2 col-form-label">Tunggakan</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="tunggakanbln" name="tunggakanbln">
            </div>
          </div>
          <div class="form-group row">
            <label for="jkw" class="col-sm-2 col-form-label">Jangka Waktu Dalam Bulan</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jkw" name="jkw">
            </div>
          </div>
          <div class="form-group row">
            <label for="angsuran" class="col-sm-2 col-form-label">Angsuran</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="angsuran" name="angsuran">
            </div>
          </div>
          <div class="form-group row">
            <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kecamatan" name="kecamatan">
            </div>
          </div>
          <div class="form-group row">
            <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kelurahan" name="kelurahan">
            </div>
          </div>
          <button class="btn btn-primary " type="submit">Simpan Data Debitur</button>
        </form>
      </div>
    </div>

  </div>
@endsection