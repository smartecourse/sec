@extends('admin.core.core-dashboard')
@section('onPage', 'Transaksi')
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
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row d-flex justify-content-between mb-2">
                        <div class="col-xl-6 col-md-6">
                            <form action="{{ route('transaksi.index') }}" method="get">
                                <label for="dari">Dari :</label>
                                <input type="date" class="form-control @error('dari') is-invalid @enderror" name="dari" id="dari" value="{{old('dari', isset($_GET['dari']) ? $_GET['dari'] : '')}}" required>
                                @error('dari')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="sampai">Sampai :</label>
                                <input type="date" class="form-control @error('sampai') is-invalid @enderror" name="sampai" id="sampai" value="{{old('sampai', isset($_GET['sampai']) ? $_GET['sampai'] : '')}}" required>
                                @error('sampai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Submit" class="btn btn-primary mt-2">
                                </div>
                            </form>
                        </div>
                    </div>                    
                    @if (isset($_GET['dari']) && isset($_GET['sampai']))
                    @if (count($listTransaksi) > 0)
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="alert alert-primary mt-2" role="alert">
                                Data transaksi dari <strong>{{$_GET['dari']}}</strong> sampai <strong>{{$_GET['sampai']}}</strong>.
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="alert alert-warning mt-2" role="alert">
                                Tidak ada transaksi di tanggal <strong>{{$_GET['dari']}}</strong> sampai <strong>{{$_GET['sampai']}}</strong>.
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                    @php
                        $grantTotal = 0;
                    @endphp
                    <table class="table table-bordered thisDisplay" id="dataTableTransaksi" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>No.</center></th>
                                <th><center>Kode Transaksi</center></th>
                                <th><center>User</center></th>
                                <th><center>Kelas</center></th>
                                <th><center>Diskon</center></th>
                                <th><center>Harga Kelas</center></th>
                                <th><center>Metode Pembayaran</center></th>
                                <th><center>Status</center></th>
                                <th><center>Berakhir pada</center></th>
                                <th><center>Waktu</center></th>
                                <th><center>Grand Total</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listTransaksi as $item)
                            @php
                                $grantTotal += $item->grand_total;
                            @endphp
                            <tr>
                                <td class="align-middle"><center>{{$loop->iteration}}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->kode_transaksi) }}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->nama) }}</center></td>
                                <td class="align-middle"><center>{{ ucwords($item->nama_paket) }} - {{ ucwords($item->nama_jenis_kelas) }}</center></td>
                                <td class="text-center">{{ $item->diskon }}%</td>
                                <td class="align-right">Rp.{{ number_format($item->harga, 2, ',', '.') }}</td>
                                <td class="text-center">{{ isset($item->metode_pembayaran) ? ucwords($item->metode_pembayaran) : '-' }}</td>
                                <td class="align-middle {{ $item->status == 'disetujui' ? 'text-success' : ($item->status == 'sedang diproses' ? 'text-primary' : 'text-danger') }}"><center>{{ $item->status == 'ditolak' ? 'DIBATALKAN' : strtoupper($item->status) }}</center></td>
                                <td class="text-center">{{ $item->tanggal_deadline }}</td>
                                <td class="align-middle"><center>{{ date('Y-m-d H:m:s', strtotime($item->updated_at)) }}</center></td>
                                <td class="align-right">Rp.{{ number_format($item->grand_total, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-primary">
                            <tr>
                                <th class="text-light text-center" colspan="10">Sub Total</th>
                                <th class="text-light align-right" >Rp.{{number_format($grantTotal, 2, ',', '.')}}</th>
                            </tr>
                        </tfoot>
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