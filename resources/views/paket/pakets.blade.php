@extends('layout.main')
@section('judul', 'Paket Kuota')

@section('breadcrumb', 'Paket Kuota')
@section('content')

  <div class="col-md-12">
    <div class="card">
      <div id="flash" data-flash="{{session()->get('success')}}"></div>
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <label for="">From</label>
            <input class="form-control" type="date" name="" value="">
          </div>
          <div class="col-md-2">
            <label for="">To</label>
            <input class="form-control" type="date" name="" value="">
          </div>
          <div class="col-md-2">
            <label for="">Filter</label>
            <select class="form-control" name="filter">
              <option value="">All</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="">Export</label> <br>
            <a class="btn btn-success" name="button"><i class="fa fa-file-excel"></i> &nbsp Excel</a>
            <a class="btn btn-danger" name="button"><i class="fa fa-file"></i> &nbsp Pdf</a>
          </div>
          <div class="col-md-2 mt-2">
            <br>
            <a style="width: 170px;" href="" class="btn btn-info">REFRESH</a>
          </div>
          <div class="col-md-2 mt-2">
            <br>
            <a style="width: 170px;" data-toggle="modal" data-target="#addModal" class="btn btn-default"><i class="fa fa-plus"></i> &nbsp Create</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table bordered">
          <thead style="background-color: #50C227;">
            <tr class="text-white">
              <th>Paket Kuota</th>
              <th>Berat</th>
              <th>Harga</th>
              <th>Cabang</th>
              <th>Created At</th>
              <th>Aktif</th>
              <th style="width: 80px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($paket as $data)
            <div class="modal modal fade" id="edit-Modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label">Paket Kuota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="" action="{{url('paket/'.$data->id)}}" method="post">
                      @csrf
                      <label>Paket Kuota</label>
                      <select class="form-control" name="paket">
                        <option value="KUOTA SETRIKA">KUOTA SETRIKA</option>
                        <option value="KUOTA CUCI">KUOTA CUCI</option>
                        <option value="KUOTA JEMUR">KUOTA JEMUR</option>
                        <option value="KUOTA LENGKAP">KUOTA LENGKAP</option>
                      </select>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Berat</label>
                          <input type="text" class="form-control" name="berat" value="{{$data->berat}}">
                        </div>
                        <div class="col-md-6">
                          <label>Satuan</label>
                          <select class="form-control" name="satuan_id" >
                            <option value="{{$data->satuan_id}}">{{$data->satuan}}</option>
                            @foreach($satuan as $values)
                            <option value="{{$values->id}}">{{$values->satuan}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <label for="">Harga<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="harga" value="{{$data->harga}}" required>
                      <div class="form-group">
                        <label for="">Cabang<span class="text-danger">*</span> </label>
                        <input type="text" name="cabang" value="{{$data->cabang}}" class="form-control" required>
                      </div>
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
              <td>{{$data->paket}}</td>
              <td>{{$data->berat}}&nbsp{{$data->satuan->satuan}}</td>
              <td>Rp {{ $data->harga }}</td>
              <td>{{$data->cabang}}</td>
              <td>{{$data->created_at}}</td>
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
                    <a data-toggle="modal" data-target="#edit-Modal{{$data->id}}" class="dropdown-item" href="">&nbsp<i class="fa fa-info"></i>&nbsp &nbsp Detail</a>
                      </form>
                      <form class="d-inline" action="{{url('aktif-paket/'.$data->id)}}" method="post">
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
          <h5 class="modal-title" id="exampleModalLabel">Paket Kuota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('tambah-paket')}}" method="post">
            @csrf
            <label for="">Paket Kuota <span class="text-danger">*</span> </label>
            <select class="form-control" name="paket" required>
              <option value="KUOTA SETRIKA">KUOTA SETRIKA</option>
              <option value="KUOTA CUCI">KUOTA CUCI</option>
              <option value="KUOTA JEMUR">KUOTA JEMUR</option>
              <option value="KUOTA LENGKAP">KUOTA LENGKAP</option>
            </select>
            <div class="row">
              <div class="col-md-6">
                <label for="">Berat<span class="text-danger">*</span> </label>
                <input class="form-control" type="text" name="berat" required>
              </div>
              <div class="col-md-6">
                <label for="">Satuan<span class="text-danger">*</span> </label>
                <select class="form-control" name="satuan_id" required>
                  <option value="">-- Pilih Satuan --</option>
                  @foreach($satuan as $data)
                  <option value="{{$data->id}}">{{$data->satuan}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <label for="">Harga<span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="harga" placeholder="Harga" required>
            <div class="form-group">
              <label for="">Cabang<span class="text-danger">*</span> </label>
              <input type="text" name="cabang" class="form-control" required>
            </div>
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
