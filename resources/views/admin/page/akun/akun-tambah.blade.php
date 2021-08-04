@extends('admin.core.core-dashboard')
@section('onPage', 'Tambah Akun')
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
              <h6 class="m-0 font-weight-bold text-primary">Form Data User / Admin</h6>
            </div>
            <form class="card-body" method="POST" enctype="multipart/form-data" action="{{url('/master/akun/save')}}">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap" class="ml-1">Nama Lengkap* :</label>
                    <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Nama Lengkap..." value="{{old('nama_lengkap')}}" autocomplete="off">
                    @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="ml-1">Email* :</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email..." value="{{old('email')}}" autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="ml-1">Password* :</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password..." value="{{old('password')}}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_konfirmasi" class="ml-1">Konfirmasi Password* :</label>
                            <input type="password" class="form-control  @error('password_konfirmasi') is-invalid @enderror" name="password_konfirmasi" placeholder="Konfirmasi Password..." value="{{old('password_konfirmasi')}}">
                            @error('password_konfirmasi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tentang_saya" class="ml-1">Tentang Saya :</label>
                    <textarea name="tentang_saya" id="tentang_saya" class="form-control @error('tentang_saya') is-invalid @enderror" rows="3" placeholder="Tentang Saya...">{{old('tentang_saya')}}</textarea>
                    @error('tentang_saya')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="foto_profil">Foto Profil</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto_profil" id="foto_profil" aria-describedby="foto_profil" @error('foto_profil') is-invalid @enderror">
                            <label class="custom-file-label" for="foto_profil">Choose File...</label>
                        </div>
                        @error('foto_profil')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="status_member" class="ml-1">Role :</label>
                    <select class="custom-select" name="status_member">
                        <option value="reguler" @if(old('status_member') == 'reguler') selected @endif>Reguler</option>
                        <option value="private" @if(old('status_member') == 'private') selected @endif>Private</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="roled" class="ml-1">Role :</label>
                    <select class="custom-select" name="roled">
                        <option value="admin" @if(old('roled') == 'admin') selected @endif>Admin</option>
                        <option value="users" @if(old('roled') == 'users') selected @endif>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-icon-split mt-2 float-right" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection