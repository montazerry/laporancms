@extends('layouts.menu')

@section('content')
   <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-2">
         <a href="{{ route('lapcall.create') }}" class="btn btn-primary btn-rounded btn-fw page-header"><i class="fa fa-plus"></i> Input Data Laporan Deskcall</a>
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

      <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Data Laporan DeskCall
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>
                        Nama User
                      </th>
                      <th>
                        Nama Debitur
                      </th>
                      <th>
                         Risk Code
                      </th>
                      <th>
                        Tanggal
                      </th>
                      <th>
                        Laporan
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
                          
                            {{$data->user['name']}}
                          
                      </td>

                      <td>
                            {{$data->debitur['nama']}}
                      </td>
                      <td>
                            {{$data->code['riskcode']}}
                      </td>
                      <td>
                            {{date('d/m/y',strtotime($data->tanggal))}}
                      </td>
                      <td>
                            {{$data->laporan}}
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <li>
                              <a class="" href="{{route('lapcall.edit',$data->id)}}"> Edit </a>
                            </li>
                            <li>
                              <form action="{{ route('lapcall.destroy', $data->id) }}" class="pull-left"  method="post">
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