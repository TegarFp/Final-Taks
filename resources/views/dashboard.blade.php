@extends('layout.main')
@section('judul', 'Satuan')

@section('breadcrumb', 'Satuan')
    
@section('content')
    
  <div class="col-md-12">
    <div class="card">
      <div id="flash" data-flash="{{ session()->get('success') }}"></div>
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <label for="">From</label>
            <input class="form-control" type="date" name="" value="">
          </div>
          <div class="col-md-2">
            <label for="">To</label>
            <input type="date" class="form-control" name="" value="">
          </div>
          <div class="col-md-2">
            <label for="">Filter</label>
            <select name="filter" class="form-control">
              <option value="">All</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="">Export</label><br>
            <a class="btn btn-success" name="button"><i class="fa fa-file-excel">&ensp; Excel</i></a>
            <a class="btn btn-danger" name="button"><i class="fa fa-file-pdf">&ensp; Pdf</i></a>
          </div>
          <div class="col-md-2 mt-2">
            <br>
            <a style="width: 170px" href="" class="btn btn-info">REFRESH</a>
          </div>
          <div class="col-md-2 mt-2">
            <br>
            <a style="width: 170px;" data-toggle="modal" data-target="#addModal" class="btn btn-default"><i class="fa fa-plus"></i> &ensp; Create</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table bordered">
          <thead style="background-color: #50C227">
            <tr class="text-white">
              <th>Satuan Unit</th>
              <th>Deskripsi</th>
              <th>Aktif</th>
              <th style="width: 80px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($satuan as $data)
            <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="" action="{{url('satuan-update/'.$data->id)}}" method="post">
                      @csrf
                      <label>Asal</label>
                      <input type="text" class="form-control" name="satuan" value="{{$data->satuan}}">
                      <label>Jumlah</label>
                      <input type="text" class="form-control" name="deskripsi" value="{{$data->deskripsi}}">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>
            <tr>
              <td>{{ $data->satuan }}</td>
              <td>{{ $data->deskripsi }}</td>
              <td>
                <span class="badge badge-sm {{ ($data->status == '1')?'bg-gradient-success' : 'bg-gradient-danger' }}">
              {{ ($data->status == '1')? 'Aktif' : 'Tidak Aktif'}}
               </span>
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Action</button>
                  <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu text-left" role="menu">
                    <form class="" action="{{url('satuan')}}" method="put">
                    <a data-toggle="modal" data-target="#editModal{{$data->id}}" class="dropdown-item" href="">&nbsp<i class="fa fa-info"></i>&nbsp &nbsp Detail</a>
                      </form>
                      <form class="d-inline" action="{{url('update-aktif/'.$data->id)}}" method="post">
                      @csrf
                      @if($data->status == '0')
                    <input type="hidden" name="_method" value="PUT">
                    <button href="" name="status" class="dropdown-item" value="1">
                      <i class="fas fa-power-off"></i>&nbsp Aktif
                    </button>
                    @else
                  <input type="hidden" name="_method" value="PUT">
                  <button href="" name="status" class="dropdown-item" value="0">
                    <i class="fas fa-power-off"></i>&nbsp Nonaktif
                </button>
                @endif
              </form>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Satuan Unit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('satuan')}}" method="post">
            @csrf
            <label for="">Satuan Unit <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="satuan" placeholder="Satuan Unit" required autofocus>
            <label for="">Deskripsi<span class="text-danger">*</span> </label>
            <textarea name="deskripsi" class="form-control" rows="3" cols="80"></textarea>
            <input type="hidden" name="status" value="0">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </div>
  </div>

@endsection