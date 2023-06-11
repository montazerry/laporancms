@section('js')
<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
@stop
@extends('layouts.menu')

@section('content')
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-2 ">
          <a href="{{route('debitur.create')}}" class="btn btn-primary btn-rounded btn-fw  page-header"><i class="fa fa-plus"></i> Tambah Debitur</a>
        </div>
        <div class="col-lg-5">
        <form action="{{ url('import_debitur') }}" method="post" class="form-inline  page-header" enctype="multipart/form-data">
            {{ csrf_field() }} 
            <div class="input-group {{ $errors->has('importDebitur') ? 'has-error' : '' }}">
              <input type="file" class="form-control" name="importDebitur" required="">
              <span class="input-group-btn">
                  <button type="submit" class="btn btn-success" style="height: 34px;margin-left: -2px;">Import</button>
              </span>
            </div>
          </form>
        </div>
      </div>
      <!-- end header -->

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

      <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Data Buku
              <a href="{{route('formatdebitur')}}" class="btn btn-xs btn-info pull-right">Format Debitur</a>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>
                        Rekening
                      </th>
                      <th>
                        SPK
                      </th>
                      <th>
                         Nama Debitur
                      </th>
                      <th>
                        Bln Tunggakan
                      </th>
                      <th>
                        Angsuran
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($datas as $data)
                    <tr>
                      <td>
                          
                            {{$data->rekening}}
                          
                      </td>

                      <td>
                            {{$data->spk}}
                      </td>
                      <td>
                            {{$data->nama}}
                      </td>
                      <td>
                            {{$data->tunggakanbln}}
                      </td>
                      <td>
                            {{$data->angsuran}}
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <li>
                              <a href="#"> Edit </a>
                            </li>
                            <li>
                            <form action="{{ route('debitur.destroy', $data->id) }}" class="pull-left"  method="post">
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