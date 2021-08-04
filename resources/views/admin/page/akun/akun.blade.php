@extends('admin.core.core-dashboard')
@section('onPage', 'Akun')
@section('extraCSS')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    @if (session('status'))
        <div class="alert alert-success sb-alert-icon m-3 w-100" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="sb-alert-icon-content">
                {{session('status')}}
            </div>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger sb-alert-icon m-3 w-100" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="sb-alert-icon-content">
                {{session('error')}}
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-12">
        <a href="{{url('/master/akun/add')}}">
            <button class="btn btn-primary btn-icon-split mb-3 float-left">
                <span class="icon text-white">
                    <i class="fas fa-plus"></i>&nbsp;Tambah Data
                </span>
            </button>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Akun - User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTableUser" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>No.</center></th>
                                <th><center>Nama</center></th>
                                <th><center>Email</center></th>
                                <th><center>Dibuat</center></th>
                                <th><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listDataUser as $item)
                            <tr>
                                <td class="align-middle"><center>{{$loop->iteration}}</center></td>
                                <td class="align-middle"><center>{{$item->nama}}</center></td>
                                <td class="align-middle"><center>{{$item->email}}</center></td>
                                <td class="align-middle"><center>{{$item->created_at}}</center></td>
                                <td class="align-middle"><center>
                                    <form action="{{url('/master/akun')}}/{{$item->id}}/detail" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </form> |
                                    <form action="{{url('/master/akun')}}/{{$item->id}}/reset" method="POST" class="d-inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-dark btn-circle" onclick="return confirm('Reset Password ?')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </form> |
                                    <form action="{{url('/master/akun')}}/{{$item->id}}/drop" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger btn-circle" onclick="return confirm('Hapus Data ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </center></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Akun - Admin</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTableAdmin" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>No.</center></th>
                                <th><center>Nama</center></th>
                                <th><center>Email</center></th>
                                <th><center>Dibuat</center></th>
                                <th><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listDataAdmin as $item)
                            <tr>
                                <td class="align-middle"><center>{{$loop->iteration}}</center></td>
                                <td class="align-middle"><center>{{$item->nama}}</center></td>
                                <td class="align-middle"><center>{{$item->email}}</center></td>
                                <td class="align-middle"><center>{{$item->created_at}}</center></td>
                                <td class="align-middle"><center>
                                    <form action="{{url('/master/akun')}}/{{$item->id}}/detail" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </form> |
                                    <form action="{{url('/master/akun')}}/{{$item->id}}/reset" method="POST" class="d-inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-dark btn-circle" onclick="return confirm('Reset Password ?')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </form> |
                                    <form action="{{url('/master/akun')}}/{{$item->id}}/drop" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger btn-circle" onclick="return confirm('Hapus Data ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </center></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('extraJS')
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#dataTableUser').DataTable();
        $('#dataTableAdmin').DataTable();
    });
</script>
@endsection