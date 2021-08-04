@extends('admin.core.core-dashboard')
@section('onPage', 'Detail Akun')
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
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <th class="w-25">Nama Lengkap</th>
                                <td>{{$getUserDetail->nama}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Email</th>
                                <td>{{$getUserDetail->email}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Tentang Saya</th>
                                <td>{{$getUserDetail->tentang_saya}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Foto Profile</th>
                                <td>
                                    @if ($getUserDetail->foto_profil == NULL)
                                        <img class="img-profile rounded-circle" src="{{asset('image/avatar/userpng.png')}}">
                                    @else
                                        <img class="img-profile rounded-circle" src="{{asset('upload/fotoProfil/'.$getUserDetail->foto_profil)}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">Status Member</th>
                                <td>{{$getUserDetail->status_member}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Akun Aktif ?</th>
                                <td>{{$getUserDetail->is_active}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right pr-5">
                        <form action="{{url('/master/akun')}}/{{$getUserDetail->id}}/reset" method="POST" class="d-inline">
                            @method('patch')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-dark" onclick="return confirm('Reset Password ?')">
                                <i class="fas fa-history"></i> &nbsp; 
                                Reset Password
                            </button>
                        </form>
                        <form action="{{url('/master/akun')}}/{{$getUserDetail->id}}/drop" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data ?')">
                                <i class="fas fa-trash"></i> &nbsp; 
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection