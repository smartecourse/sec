@extends('admin.core.core-dashboard')
@section('onPage', 'Tambah Kelas')
@section('extraCSS')
<!-- include summernote css -->
<link href="{{ asset('admin/summernote/summernote.min.css') }}" rel="stylesheet">
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
    <div class="col">
        <a href="{{route('kelas.index')}}">
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
              <h6 class="m-0 font-weight-bold text-primary">Form Data Kelas</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="kode_kelas" class="ml-1">Kode Kelas :</label>
                    <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" name="kode_kelas" placeholder="ex : KK00001" value="{{ $kelas->kode_kelas }}" autocomplete="off" readonly>
                    @error('kode_kelas')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_kelas" class="ml-1">Nama Kelas<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('nama_kelas') is-invalid @enderror" name="nama_kelas" placeholder="ex : Kelas Bahasa Inggris" value="{{ $kelas->nama }}" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="ml-1">Deskripsi :</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" readonly>{{ $kelas->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="intro_video" class="ml-1">Intro Video : <span class="text-danger">*</span> :</label><br>
                    {!! $kelas->intro_link !!}
                </div>
                <div class="form-group">
                    <label for="intro" class="ml-1">Intro:</label>
                    <textarea name="intro" id="intro" readonly>{{ $kelas->intro }}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover">Sampul</label><br>
                    <a style="cursor: pointer;" data-toggle="modal" class="showDetailData" data-target=".modal-show-detail" data-image="{{ url('', $kelas->cover) }}">
                        <img src="{{ asset($kelas->cover) }}" class="rounded mr-4" width="240" height="150" alt="" srcset="">
                    </a>
                </div>
                <div class="form-group">
                    <label for="author" class="ml-1">Author<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('author') is-invalid @enderror" name="author" placeholder="ex : Ahmad Dahlan" value="{{ $kelas->author }}" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="jenis_kelas" class="ml-1">Jenis Kelas<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('author') is-invalid @enderror" name="jenis_kelas" value="{{$kelas->nama_jenis_kelas}}" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="author" class="ml-1">Tipe Kelas :<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('author') is-invalid @enderror" name="tipe_kelas" value="{{ ucfirst($kelas->tipe_kelas) }}" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="harga" class="ml-1">Harga<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('harga') is-invalid @enderror" name="harga" placeholder="ex : 30000" value="Rp{{ number_format($kelas->harga, 2, ',', '.') }}" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="diskon" class="ml-1">Diskon - % :</label>
                    <input type="text" class="form-control  @error('diskon') is-invalid @enderror" name="diskon" placeholder="ex : 30" value="{{old('diskon', $kelas->diskon == null || $kelas->diskon == 0) ? '0' : $kelas->diskon }}%" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="pdf_file">PDF</label><br>
                    @php
                        if ($kelas->pdf_file != null || $kelas->pdf_file != '') {
                            $pdf_filename = explode('/', $kelas->pdf_file);
                            $pdf_filename = $pdf_filename[3];
                        }
                    @endphp
                    <a href="{{ $kelas->pdf_file != null ? asset($kelas->pdf_file) : '#' }}" target="blank">{{ $kelas->pdf_file != null ? $pdf_filename : 'Tidak ada file pdf.' }}</a>
                </div>
                <div class="form-group">
                    <label for="deadline" class="ml-1">Masa berlaku (hari)<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('deadline') is-invalid @enderror" name="deadline" placeholder="ex : 30" value="{{ $kelas->deadline }} hari" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="link_zoom" class="ml-1">Link Zoom :</label>
                    <input type="text" class="form-control  @error('link_zoom') is-invalid @enderror" name="link_zoom" placeholder="ex : https://us04web.zoom.us/wc/71759035374/start" value="{{ $kelas->link_zoom != null ? $kelas->link_zoom : 'Link zoom belum tersedia.' }}" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                    <label for="status_kelas" class="ml-1">Status Kelas :</label>
                    <input type="text" class="form-control  @error('status_kelas') is-invalid @enderror" name="status_kelas" value="@if($kelas->is_active == 'active') Aktif @endif @if($kelas->is_active == 'deadactive') Nonaktif @endif" autocomplete="off" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-show-detail">
    <div class="modal-dialog" style="max-width: 50% !important;">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          {{-- <h6 class="modal-title">Detail Data</h6> --}}
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body text-center">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <img alt="" class="rounded" id="showDetail" width="100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('extraJS')
<script>
    $(document).ready(function() {
        $('.showDetailData').click(function (e) {
            let imageSrc = $(this).data('image');
            $('.modal-body #showDetail').attr('src', imageSrc);
        });
    });
</script>
<!-- include summernote js -->
<script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#intro').summernote('disable');
    });
</script>
@endsection
