@section('js')

@stop
@extends('layouts.menu')

@section('content')
  <div id="page-wrapper">
    <div class="row">
      <div class="col">
        <h3 class="page-header">Ubah Data User</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <form method="post" action="{{route('user.update',$data->id)}}"> 
        {{ csrf_field() }}
        {{ method_field('put') }}
          <div class="row">
            <div class="col-md-5">
              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Nama Debitur</label>
                  <input type="text" class="form-control" id="name" placeholder="Nama" name="name" required readonly="" value="{{ $data->name }}">
                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
              </div>
              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" >
                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
              </div>
              <div class="form-group {{ $errors->has('passwordbaru') ? ' has-error' : '' }}">
                  <label for="passwordbaru">Password Baru</label>
                  <input type="passwordbaru" class="form-control" name="passwordbaru" id="passwordbaru">
                  @if ($errors->has('passwordbaru'))
                    <span class="help-block">
                        <strong>{{ $errors->first('passwordbaru') }}</strong>
                    </span>
                  @endif
              </div>
              <button type="submit" class="btn btn-primary" id="submit">
                  Update
              </button>
            </div>
          </div>        
        </form>
      </div>
    </div>

  </div>
@endsection