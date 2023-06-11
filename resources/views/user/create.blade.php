@section('js')

@stop
@extends('layouts.menu')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col">
        <h3 class="page-header">Input Data User</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <form method="post" action="{{route('user.store')}}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="E-Mail" name="email">
          </div>
          <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
      </div>
    </div>

  </div>
@endsection