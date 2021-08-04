@extends('admin.core.core-dashboard')
@section('onPage', 'Tambah Materi')
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
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{route('materi.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kelas" class="ml-1">Kelas<span class="text-danger">*</span> :</label>
                            <select class="custom-select" name="kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($listKelas as $item)                        
                                    <option value="{{$item->id}}" @if(old('kelas') == '{{$item->id}}') selected @endif>{{$item->judul_kelas}} - {{$item->nama_jenis_kelas}} ({{$item->tipe_kelas}})</option>
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
                            <input type="text" class="form-control  @error('nama_materi') is-invalid @enderror" name="nama_materi" placeholder="ex : Pendahuluan" value="{{old('nama_materi')}}" autocomplete="off">
                            @error('nama_materi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="urutan" class="ml-1">Urutan<span class="text-danger">*</span> :</label>
                            <input type="number" class="form-control  @error('urutan') is-invalid @enderror" name="urutan" placeholder="ex : 1" value="{{old('urutan')}}" autocomplete="off">
                            @error('urutan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="border">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Data Konten Materi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="urutan" class="ml-1">Urutan<span class="text-danger">*</span> :</label>
                                    <input type="number" class="form-control  @error('urutan') is-invalid @enderror" name="urutan" placeholder="ex : 1" value="{{old('urutan')}}" autocomplete="off">
                                    @error('urutan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="judul_konten_materi" class="ml-1">Judul Konten Materi<span class="text-danger">*</span> :</label>
                                    <input type="text" class="form-control  @error('judul_konten_materi') is-invalid @enderror" name="judul_konten_materi" placeholder="ex : Pengenalan Vocabulary" value="{{old('judul_konten_materi')}}" autocomplete="off">
                                    @error('judul_konten_materi')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="konten" class="ml-1">Konten (PDF/Link Video)<span class="text-danger">*</span> :</label>
                                    <input type="text" class="form-control  @error('konten') is-invalid @enderror" name="konten" placeholder="ex : https://www.youtube.com/watch?v=SDROba_M42g" value="{{old('konten')}}" autocomplete="off">
                                    @error('konten')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi" class="ml-1">Deskripsi<span class="text-danger">*</span> :</label>
                                    <textarea name="deskripsi" id="deskripsi">{{old('deskripsi')}}</textarea>
                                    @error('deskripsi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                        <div class="panel panel-default mt-3">
                            <div class="panel-body">
                                <div id="konten_materi_fields"></div>
                                <div class="border">
                                    <div class="card-header py-3">
                                        <div style="height: 35px">
                                            <h6 class="mt-2 font-weight-bold text-primary float-left">Form Data Konten Materi</h6>
                                            <button class="btn btn-info float-right" type="button"  onclick="konten_materi_fields();"> + </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="urutan_konten_materi" class="ml-1">Urutan Konten Materi<span class="text-danger">*</span> :</label>
                                            <input type="number" class="form-control  @error('urutan_konten_materi') is-invalid @enderror" name="urutan_konten_materi[]" placeholder="ex : 1" value="{{old('urutan_konten_materi')}}" autocomplete="off">
                                            @error('urutan_konten_materi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="judul_konten_materi" class="ml-1">Judul Konten Materi<span class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control  @error('judul_konten_materi') is-invalid @enderror" name="judul_konten_materi[]" placeholder="ex : Pengenalan Vocabulary" value="{{old('judul_konten_materi')}}" autocomplete="off">
                                            @error('judul_konten_materi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="konten" class="ml-1">Konten Video (untuk kelas video) :</label>
                                            <input type="text" class="form-control  @error('konten') is-invalid @enderror" name="konten[]" placeholder="ex : https://www.youtube.com/watch?v=SDROba_M42g" value="{{old('konten')}}" autocomplete="off">
                                            @error('konten')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi" class="ml-1">Konten Ebook (untuk kelas ebook):</label>
                                            <textarea name="deskripsi[]" id="deskripsi" rows="3" class="form-control">{{old('deskripsi')}}</textarea>
                                            @error('deskripsi')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
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

@section('extraJS')
<script>
    var room = 1;
    function konten_materi_fields() {
    
        room++;
        var objTo = document.getElementById('konten_materi_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+room);
        var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="border"> <div class="card-header py-3"> <div style="height: 35px"> <h6 class="mt-2 font-weight-bold text-primary float-left">Form Data Konten Materi</h6> <button class="btn btn-danger float-right" type="button" onclick="remove_konten_materi_fields('+ room +');">&nbsp;-&nbsp;</button> </div> </div> <div class="card-body"> <div class="form-group"> <label for="urutan_konten_materi" class="ml-1">Urutan Konten Materi<span class="text-danger">*</span> :</label> <input type="number" class="form-control @error('urutan_konten_materi') is-invalid @enderror" name="urutan_konten_materi[]" placeholder="ex : 1" value="{{old('urutan_konten_materi')}}" autocomplete="off"> @error('urutan_konten_materi') <div class="invalid-feedback"> {{$message}} </div> @enderror </div> <div class="form-group"> <label for="judul_konten_materi" class="ml-1">Judul Konten Materi<span class="text-danger">*</span> :</label> <input type="text" class="form-control @error('judul_konten_materi') is-invalid @enderror" name="judul_konten_materi[]" placeholder="ex : Pengenalan Vocabulary" value="{{old('judul_konten_materi')}}" autocomplete="off"> @error('judul_konten_materi') <div class="invalid-feedback"> {{$message}} </div> @enderror </div> <div class="form-group"> <label for="konten" class="ml-1">Konten Video (untuk kelas video) :</label> <input type="text" class="form-control @error('konten') is-invalid @enderror" name="konten[]" placeholder="ex : https://www.youtube.com/watch?v=SDROba_M42g" value="{{old('konten')}}" autocomplete="off"> @error('konten') <div class="invalid-feedback"> {{$message}} </div> @enderror </div> <div class="form-group"> <label for="deskripsi" class="ml-1">Konten Ebook (untuk kelas ebook):</label> <textarea name="deskripsi[]" id="deskripsi" rows="3" class="form-control">{{old('deskripsi')}}</textarea> @error('deskripsi') <p class="text-danger">{{ $message }}</p> @enderror </div> </div> </div>';
        
        objTo.appendChild(divtest)
    }
   function remove_konten_materi_fields(rid) {
	   $('.removeclass'+rid).remove();
   }
</script>
<!-- include summernote js -->
<script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#deskripsi').summernote({
            placeholder: 'Masukkan deskripsi disini',
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