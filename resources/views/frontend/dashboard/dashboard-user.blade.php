@extends('frontend.dashboard.layouts.template')
@section('dashboard-css')<link rel="stylesheet" href="{{ asset('frontend/assets/css/app.css') }}">@endsection
@section('content')
<div class="main-content container-fluid">
    <section class="section">
        {{-- <div class="text-center p-5">
            <h1 style="font-weight: bold">Selamat Datang,  {{ Session::get('nama') }}</h1>
            <hr class="w-25 mx-auto" style="border: 2px solid #0af">
        </div> --}}
        <div>
            <h4 style="font-weight: bold">Dashboard</h4>
            <hr class="mb-4" width="100px" style="border: 2px solid #0af">
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-5" style="padding-bottom: 12px !important">
                            <div class="col-lg-4">
                                <div class="img-status-member p-2 d-flex justify-content-center ">
                                    @if (Session::get('is_google') == 1 )
                                        <img src=" {{ Session::get('foto_profil') != null ? Session::get('foto_profil') : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid login-img" alt="">
                                    @else
                                        <img src=" {{ Session::get('foto_profil') != null ? asset('upload/fotoProfil/'.Session::get('foto_profil')) : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid login-img" alt="">
                                    @endif
                                 </div>
                            </div>
                            <div class="col-lg-8">
                                <h1 style="font-weight: bold">Selamat Datang,  {{ Session::get('nama') }}</h1>
                                <div class="d-flex">
                                    <div class="p-1">
                                        @if (Session::get('status_member') != 'regular')
                                            <span class="badge bg-info">{{ Session::get('status_member') }}</span>
                                        @else
                                            <span class="badge bg-info">{{ Session::get('status_member') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="p-2 tex-muted">
                                    {{ Session::get('profil_saya') }}
                                </p>

                            </div>
                            <hr class="mt-4">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 ml-5 p-0 card-body">

                               <h4 class="mb-4" style="font-weight: bold">Progres Belajar</h4>
                               {{-- <p>Kelas 1</p>
                               <div class="progress progress-info mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div> --}}
                                @foreach ($kelas as $item)
                                @php
                                    $totalMateri = \App\Models\MateriKonten::select('materi_konten.id')
                                                                            ->join('materi', 'materi.id', 'materi_konten.materi_id')
                                                                            ->where('materi.kelas_id', $item->kelas_id)
                                                                            ->count();
                                    // echo 'total materi'.$item->kelas_id;
                                    $totalMateriSelesai = \App\Models\MateriKontenSelesai::select('id')->where('kelas_aktif_id', $item->id)->count();

                                    if($totalMateri > 0) {
                                        $progress = (100 / $totalMateri) * $totalMateriSelesai;
                                    }
                                    else {
                                        $progress = 0;
                                    }
                                    $progress = round($progress, 0);
                                @endphp
                                <p><strong>{{ ucwords($item->judul_kelas).' - '.ucwords($item->tipe_kelas) }}</strong></p>
                                <div class="progress progress-primary  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: {{ $progress }}%;"  aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-end mb-5">
                                    <a href="{{ url($item->tipe_kelas == 'video' ? 'dashboard/detail-kelas-aktif-video/'.$item->slug : 'dashboard/detail-kelas-aktif-ebook/'.$item->slug) }}" class="btn btn-primary" style="padding-top: 12px; padding-bottom: 12px">
                                        {{ $progress == 100 ? 'Lihat kelas' : 'Lanjutkan Belajar' }}
                                    </a>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('sidebar')
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header text-center">
            @if (Session::get('is_google') == 1 )
                <img src=" {{ Session::get('foto_profil') != null ? Session::get('foto_profil') : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid login-img" alt="">
            @else
                <img src=" {{ Session::get('foto_profil') != null ? asset('upload/fotoProfil/'.Session::get('foto_profil')) : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid login-img" alt="">
            @endif
            <h3 class="text-user">{{ Session::get('nama') }}</h3>
            <span class="badge {{ Session::get('status_member') == 'private' ? 'bg-warning' : 'bg-info'}}">{{ strtoupper(Session::get('status_member')) }}</span>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class='sidebar-title'>Main Menu</li>

                <li class="sidebar-item {{Request::segment(2) == '' ? 'active' : ''}} ">
                    <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::segment(2) == 'kelas-saya' ? 'active' : '' }}">
                    <a href="{{ route('kelas-saya') }}" class='sidebar-link'>
                        <i data-feather="layout" width="20"></i>
                        <span>Kelas Saya</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::segment(2) == 'group-whatsapp' ? 'active' : '' }}">
                    <a href="{{ route('group-whatsapp') }}" class='sidebar-link'>
                        <i class="fa fa-whatsapp" style="font-size: 1.5em;"></i>
                        <span>Grup WhatsApp</span>
                    </a>
                </li>

                <li class='sidebar-title'>Transaksi</li>

                <li class="sidebar-item {{ Request::segment(2) == 'list-transaksi' ? 'active' : '' }}">
                    <a href="{{ route('list-transaksi') }}" class='sidebar-link'>
                        <i data-feather="layout" width="20"></i>
                        <span>Transaksi</span>
                    </a>

                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
@endsection
