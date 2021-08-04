@extends('admin.core.core-dashboard')
@section('onPage', 'Detail Konten Materi')
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
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail Konten Materi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered thisDisplay" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <th class="w-25">Kelas - Nama Materi</th>
                                <td>{{$getDataPostTest->judul_kelas}} - {{$getDataPostTest->nama_materi}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Judul Konten Materi</th>
                                <td>{{$getDataPostTest->judul_konten_materi}}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Embed Link</th>
                                <td>{!! $getDataPostTest->embed_link !!}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Status Materi</th>
                                <td>{{$getDataPostTest->is_active}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection