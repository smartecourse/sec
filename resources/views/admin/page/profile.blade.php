@extends('admin.core.core-dashboard')
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
                {{ session('error') == 'The given data was invalid.' ? 'Harap masukkan password untuk melakukan perubahan.' : session('error') }}
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col">
        <a href="{{ url()->previous() }}">
            <button class="btn btn-primary btn-icon-split mb-3 float-left">
                <span class="icon text-white">
                    <i class="fas fa-arrow-left"></i>&nbsp;Kembali
                </span>
            </button>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{ route('admin-update-profile') }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_lengkap" class="ml-1">Nama Lengkap<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Nama Lengkap..." value="{{old('nama_lengkap', auth()->user()->nama)}}" autocomplete="off">
                    @error('nama_lengkap')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="ml-1">Email<span class="text-danger">*</span> :</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email..." value="{{old('email', auth()->user()->email)}}" autocomplete="off">
                    @error('email')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="ml-1">Password<span class="text-danger">*</span> :</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password..." value="{{old('password')}}">
                            @error('password')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="ml-1">Konfirmasi Password<span class="text-danger">*</span> :</label>
                            <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Password..." value="{{old('password_confirmation')}}">
                            @error('password_confirmation')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tentang_saya" class="ml-1">Tentang Saya :</label>
                    <textarea name="tentang_saya" id="tentang_saya" class="form-control @error('tentang_saya') is-invalid @enderror" rows="3" placeholder="Tentang Saya...">{{old('tentang_saya', auth()->user()->tentang_saya)}}</textarea>
                    @error('tentang_saya')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="foto_profil">Foto Profil :</label><br>
                        <a style="cursor: pointer;" data-toggle="modal" class="showDetailData" data-target=".modal-show-detail" data-image="{{ url('', auth()->user()->foto_profil) }}">
                            <img src="{{ asset(auth()->user()->foto_profil != null ? auth()->user()->foto_profil : 'admin/img/no_image_available.jpeg') }}" class="rounded mr-4" width="240" height="240" alt="">
                        </a>
                        <br><br>
                        <input type="file" name="foto_profil" id="foto_profil" aria-describedby="foto_profil" @error('foto_profil') is-invalid @enderror">
                        @error('foto_profil')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror
                    </div>
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
@endsection