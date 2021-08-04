@extends('admin.core.core-dashboard')
@section('onPage', 'Kelas')
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
        <a href="{{route('kelas.create')}}">
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
              <h6 class="m-0 font-weight-bold text-primary">List Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTableTransaksi" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>No.</center></th>
                                <th><center>Kode Transaksi</center></th>
                                <th><center>Kelas</center></th>
                                <th><center>User</center></th>
                                <th><center>Total</center></th>
                                <th><center>Status</center></th>
                                <th><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listTransaksi as $item)
                            <tr>
                                <td class="align-middle"><center>{{$loop->iteration}}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->kode_transaksi) }}</center></td>
                                <td class="align-middle"><center>{{ ucwords($item->nama_paket) }} - {{ ucwords($item->nama_jenis_kelas) }}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->nama) }}</center></td>
                                <td class="align-middle"><center>Rp{{ number_format($item->grand_total, 2, ',', '.') }}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->status) }}</center></td>
                                <td class="align-middle"><center>
                                    <form action="{{route('checkout', $item->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary btn-circle" onclick="return confirm('Checkout ?')">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                    </form>
                                    <a href="{{route('kelas.show', $item->id)}}">
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>|
                                    <a href="{{route('kelas.edit', $item->id)}}">
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </a>|
                                    <form action="{{route('kelas.destroy', $item->id)}}" method="POST" class="d-inline">
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
        $('#dataTableTransaksi').DataTable();
    });
</script>
@endsection