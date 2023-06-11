@section('js')

@stop
@extends('layouts.menu')

@section('content')
  <div id="page-wrapper">

    <div class="row">
      <div class="col">
        <h3 class="page-header">Daftar User</h3>
      </div>
    </div>

    @if (session('status'))
        <div class="row mt-3 ml-1">
           <div class="alert {{ session('class') }} col-lg-10">
              {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
           </div>
        </div>
        @endif

    <div class="row">
      <div class="col">
        <a href="{{route('user.create')}}" class="btn btn-primary">Tambah User</a>
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Data User
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <th>{{$user->name}}</th>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level}}</td>
                    <td>
                      <div class="btn-group">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <li>
                              <a href="{{route('user.edit',$user->id)}}"> Edit </a>
                            </li>
                            <li>
                            <form action="{{ route('user.destroy', $user->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                              <button onclick="return confirm('Anda yakin ingin menghapus data ini?')" > Delete</button>
                            </form>
                            </li>
                          </ul>
                        </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection