@extends('admin.core.core-dashboard')
@section('onPage', 'Edit Materi')

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
    <div class="col">
        <a href="{{route('materi.index')}}">
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
              <h6 class="m-0 font-weight-bold text-primary">Form Data Materi</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{route('materi.update', $getMateri->id)}}">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kelas" class="ml-1">Kelas<span class="text-danger">*</span> :</label>
                            <select class="custom-select" name="kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($listKelas as $item)                        
                                    <option value="{{$item->id}}" @if($getMateri->kelas_id == $item->id) selected @endif>{{$item->kode_kelas}} - {{$item->judul_kelas}} (Kelas {{$item->nama_jenis_kelas}})</option>
                                @endforeach
                            </select>
                            @error('kelas')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_materi" class="ml-1">Nama Materi<span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control  @error('nama_materi') is-invalid @enderror" name="nama_materi" placeholder="ex : Pendahuluan" value="{{$getMateri->nama_materi}}" autocomplete="off">
                            @error('nama_materi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="urutan" class="ml-1">Urutan<span class="text-danger">*</span> :</label>
                            <input type="number" class="form-control  @error('urutan') is-invalid @enderror" name="urutan" placeholder="ex : 1" value="{{$getMateri->urutan}}" autocomplete="off">
                            @error('urutan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-icon-split mt-3 float-right" type="submit">
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