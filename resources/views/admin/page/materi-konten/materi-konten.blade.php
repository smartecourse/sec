@extends('admin.core.core-dashboard')
@section('onPage', 'Konten Materi')
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
        <a href="{{route('konten-materi.create')}}">
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
              <h6 class="m-0 font-weight-bold text-primary">List Materi Konten</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTableMateriKonten" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><center>No.</center></th>
                                <th><center>Nama Materi</center></th>
                                <th><center>Judul Konten Materi</center></th>
                                {{-- <th><center>Konten</center></th> --}}
                                <th><center>Urutan</center></th>
                                <th><center>Status Konten Materi</center></th>
                                <th><center>Aksi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listMateriKonten as $item)
                            <tr>
                                <td class="align-middle"><center>{{$loop->iteration}}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->tipe_kelas). ' - ' .ucwords($item->judul_kelas.' - '.$item->nama_materi) }}</center></td>
                                <td class="align-middle"><center>{{$item->judul_konten_materi}}</center></td>
                                {{-- <td class="align-middle"><center>{{$item->konten}}</center></td> --}}
                                <td class="align-middle"><center>{{ strtoupper($item->urutan) }}</center></td>
                                <td class="align-middle"><center>{{ strtoupper($item->is_active) }}</center></td>
                                <td class="align-middle"><center>
                                    <a href="{{route('konten-materi.show', $item->id)}}">
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>|
                                    <a href="{{route('konten-materi.edit', $item->id)}}">
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </a>|
                                    <form action="{{route('konten-materi.destroy', $item->id)}}" method="POST" class="d-inline">
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
        $('#dataTableMateriKonten').DataTable();
    });
</script>
@endsection