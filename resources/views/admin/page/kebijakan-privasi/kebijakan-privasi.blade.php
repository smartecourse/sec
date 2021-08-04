@extends('admin.core.core-dashboard')
@section('onPage', 'Kebijakan Privasi')
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
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Kebijakan Privasi</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{ route('save-master-kebijakan-privasi') }}">
                @csrf
                <div class="form-group">
                    <label for="kebijakan" class="ml-1">Kebijakan Privasi <span class="text-danger">*</span>:</label>
                    <textarea name="kebijakan" id="kebijakan" rows="3" class="form-control">{!! old('kebijakan', $data->konten) !!}</textarea>
                    @error('kebijakan')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-icon-split mt-2 float-right" type="submit">
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
<!-- include summernote js -->
<script src="{{ asset('admin/summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#kebijakan').summernote({
            placeholder: 'Masukkan teks disini',
            tabsize: 2,
            height: 500,
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