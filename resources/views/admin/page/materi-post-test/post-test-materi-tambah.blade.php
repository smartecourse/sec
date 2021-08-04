@extends('admin.core.core-dashboard')
@section('onPage', 'Tambah Konten Materi')

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
        <a href="{{route('post-test-materi.index')}}">
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
              <h6 class="m-0 font-weight-bold text-primary">Form Data Post Test Materi</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{route('post-test-materi.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="materi" class="ml-1">Materi :<span class="text-danger">*</span> :</label>
                            <select class="custom-select" name="materi">
                                <option value="">Pilih materi</option>
                                @foreach ($listMateri as $item)                        
                                    <option value="{{$item->id}}" @if(old('materi') == '{{$item->id}}') selected @endif>{{ strtoupper($item->tipe_kelas) }} {{$item->judul_kelas}} (materi {{$item->nama_materi}})</option>
                                @endforeach
                            </select>
                            @error('materi')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="judul_post_test" class="ml-1">Judul Post Test Materi<span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control  @error('judul_post_test') is-invalid @enderror" name="judul_post_test" placeholder="ex : Pengenalan Vocabulary" value="{{old('judul_post_test')}}" autocomplete="off">
                            @error('judul_post_test')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="embed_link" class="ml-1">Embed (Link GForm) :</label>
                            <input type="text" class="form-control  @error('embed_link') is-invalid @enderror" name="embed_link" placeholder="ex : https://www.youtube.com/watch?v=SDROba_M42g" value="{{old('embed_link')}}" autocomplete="off">
                            @error('embed_link')
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