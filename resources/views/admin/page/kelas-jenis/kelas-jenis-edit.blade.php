@extends('admin.core.core-dashboard')

@section('onPage', 'Jenis Kelas')
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
    @elseif (session('error') && session('error') != 'The given data was invalid.')
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
    <div class="col">
        <a href="{{route('jenis-kelas.index')}}">
            <button class="btn btn-primary btn-icon-split mb-3 float-left">
                <span class="icon text-white">
                    <i class="fas fa-arrow-left"></i>&nbsp;Lihat Data
                </span>
            </button>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Jenis Kelas</h6>
            </div>
            <form class="card-body" method="POST" action="{{route('jenis-kelas.update', $jenisKelas->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_jenis_kelas" class="ml-1">Nama Jenis Kelas<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('nama_jenis_kelas') is-invalid @enderror" name="nama_jenis_kelas" placeholder="ex : Reguler" value="{{old('nama_jenis_kelas', $jenisKelas->nama_jenis_kelas)}}" autocomplete="off">
                    @error('nama_jenis_kelas')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="ml-1">Deskripsi<span class="text-danger">*</span> :</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5">{{ old('deskripsi', $jenisKelas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bobot" class="ml-1">Bobot<span class="text-danger">*</span> :</label>
                    <input type="number" class="form-control  @error('bobot') is-invalid @enderror" name="bobot" placeholder="ex : 0" value="{{old('bobot', $jenisKelas->bobot)}}" autocomplete="off">
                    @error('bobot')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="form-inline float-right">
                    <button class="btn btn-danger btn-icon-split mt-2 mr-2" type="reset">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync-alt"></i>
                        </span>
                        <span class="text">Batal</span>
                    </button>
                    <button class="btn btn-primary btn-icon-split mt-2" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extraJS')
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#dataTableJenisKelas').DataTable();
    });
</script>
@endsection