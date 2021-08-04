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
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{route('kelas.update', $kelas->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode_kelas" class="ml-1">Kode Kelas :</label>
                    <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" name="kode_kelas" placeholder="ex : KK00001" value="{{old('kode_kelas', $kelas->kode_kelas)}}" autocomplete="off" readonly>
                    @error('kode_kelas')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="paket_kelas" class="ml-1">Paket Kelas<span class="text-danger">*</span> :</label>
                    <select class="custom-select" name="paket_kelas">
                        <option value="0">Pilih Paket Kelas</option>
                        @foreach ($paketKelas as $item)
                        <option value="{{ $item->id }}" @if(old('paket_kelas', $kelas->paket_id) == $item->id ) selected @endif>{{ $item->nama_paket }}</option>                            
                        @endforeach
                    </select>
                    @error('paket_kelas')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="ml-1">Deskripsi :</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control">{{ $kelas->deskripsi }}</textarea>
                    @error('deskripsi')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="intro_video" class="ml-1">Intro Video : <span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('intro_video') is-invalid @enderror" name="intro_video" placeholder="ex : https://www.youtube.com/watch?v=SDROba_M42g" value="{{old('intro_video', $kelas->intro_link)}}" autocomplete="off">
                    @error('intro_video')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="intro" class="ml-1">Intro (opsional):</label>
                    <textarea name="intro" id="intro">{!! $kelas->intro !!}</textarea>
                    @error('intro')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cover">Sampul</label><br>
                    <a style="cursor: pointer;" data-toggle="modal" class="showDetailData" data-target=".modal-show-detail" data-image="{{ url('', $kelas->cover) }}">
                        <img src="{{ asset($kelas->cover) }}" class="rounded mr-4" width="240" height="150" alt="" srcset="">
                    </a>
                    <br><br>
                    <input type="file" class="form-control" name="cover" id="cover">
                    @error('cover')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author" class="ml-1">Author<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('author') is-invalid @enderror" name="author" placeholder="ex : Ahmad Dahlan" value="{{old('author', $kelas->by_author)}}" autocomplete="off">
                    @error('author')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kelas" class="ml-1">Jenis Kelas<span class="text-danger">*</span> :</label>
                    <select class="custom-select" name="jenis_kelas">
                        <option value="0">Pilih Jenis Kelas</option>
                        @foreach ($jenisKelas as $item)
                        <option value="{{ $item->id }}" @if(old('jenis_kelas', $kelas->kelas_jenis_id) == $item->id) selected @endif>{{ $item->nama_jenis_kelas }}</option>                            
                        @endforeach
                    </select>
                    @error('jenis_kelas')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tipe_kelas" class="ml-1">Tipe Kelas :</label>
                    <select class="custom-select" name="tipe_kelas">
                        <option value="0">Pilih Tipe Kelas</option>
                        <option value="ebook" @if(old('tipe_kelas', strtolower($kelas->tipe_kelas)) == 'ebook') selected @endif>Ebook</option>
                        <option value="video" @if(old('tipe_kelas', strtolower($kelas->tipe_kelas)) == 'video') selected @endif>Video</option>
                    </select>
                    @error('tipe_kelas')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pdf_file">PDF (opsional)</label><br>
                    @php
                        if ($kelas->pdf_file != null || $kelas->pdf_file != '') {
                            $pdf_filename = explode('/', $kelas->pdf_file);
                            $pdf_filename = $pdf_filename[3];
                        }
                    @endphp
                    <a href="{{ $kelas->pdf_file != null ? asset($kelas->pdf_file) : '#' }}">{{ $kelas->pdf_file != null ? $pdf_filename : 'Tidak ada file pdf.' }}</a>
                    <input type="file" class="form-control" name="pdf_file" id="pdf_file">
                    @error('pdf_file')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status_kelas" class="ml-1">Status Kelas :</label>
                    <select class="custom-select" name="status_kelas">
                        <option value="0">Pilih Status Kelas</option>
                        <option value="active" @if(old('status_kelas', strtolower($kelas->is_active)) == 'active') selected @endif>Aktif</option>
                        <option value="deadactive" @if(old('status_kelas', strtolower($kelas->is_active)) == 'deadactive') selected @endif>Nonaktif</option>
                    </select>
                    @error('status_kelas')
                    <p class="text-danger">{{ $message }}</p>
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
        $('#intro').summernote({
            placeholder: 'Masukkan deskripsi intro disini',
            tabsize: 2,
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });
</script>
@endsection