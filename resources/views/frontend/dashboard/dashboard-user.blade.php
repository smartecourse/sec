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
                                    <img class="" src="{{ Session::get('foto_profil') }}" alt="">
                                 </div>
                            </div>
                            <div class="col-lg-8">
                                <h1 style="font-weight: bold">Selamat Datang,  {{ Session::get('nama') }}</h1>
                                <div class="d-flex">
                                    <div class="p-1">
                                        @if (Session::get('status') != 'regular')
                                            <span class="badge bg-info">{{ Session::get('status') }}</span>
                                        @else
                                            <span class="badge bg-info">{{ Session::get('status') }}</span>
                                        @endif
                                    </div>
                                    <div class="p-1">
                                        @if (Session::get('is_active') == 'active')
                                            <span class="badge bg-success">{{ Session::get('is_active') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ Session::get('is_active') }}</span>
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
                                    <a href="{{ url($item->tipe_kelas == 'video' ? 'dashboard/detail-kelas-aktif-video/'.$item->slug : 'dashboard/detail-kelas-aktif-ebook/'.$item->slug) }}" class="btn btn-primary" style="padding-top: 12px; padding-bottom: 12px">Lanjutkan Belajar</a>
                                </div>
                                <hr>
                                @endforeach
                                {{-- <table class='table table-borderless mt-4'>
                                    <tr>
                                        <td class='col-md-2 p-0'>
                                            <p class="m-0"> Kelas Belajar Grammar Tahap Ke-1 -<strong>Ebook</strong> </p>

                                        </td>
                                        <td class='col-lg-8 w-100'>
                                            <div class="progress progress-info">
                                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class='col-md-2 text-center' style="padding-left: 0 !important">60%</td>
                                    </tr>
                                    <a href="#" class="btn btn-info">Lanjutkan Belajar</a>
                                    <tr>
                                        <td class='col-md-2 p-0'>
                                            <p class="m-0"> Kelas Belajar Grammar Tahap Ke-1 -<strong>Video</strong> </p>

                                        </td>
                                        <td class='col-lg-8 w-100'>
                                            <div class="progress progress-info">
                                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class='col-md-2 text-center' style="padding-left: 0 !important">60%</td>
                                        <td colspan="2" class="d-flex justify-content-end">
                                            <a href="#" class="btn btn-info">Lanjutkan Belajar</a>
                                        </td>
                                    </tr>
                                 </table>

                                <hr> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Dashboard</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="status-user">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                aria-selected="true">Status Member</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Progres Belajar</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent" style="background-color: rgba(202, 240, 248, 0.55)" style="padding: 0 !important;">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-lg-4 img-status-member p-2 d-flex justify-content-center">
                                       <img class="" src="{{  Session::get('is_google') == 0 ? asset('upload/fotoProfil/'.Session::get('foto_profil')) : Session::get('foto_profil') }}" alt="">
                                    </div>
                                    <div class="col-lg-8 mt-4">
                                        <h2 style="font-weight: bold; font-size: 48px;">{{ Session::get('nama') }}</h2>
                                        <p>
                                            {{ Session::get('profil_saya') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card-body">
                                <p>Use class <code>.progress-bar-{color-name}</code> to add different colors to progressbar.</p>
                                <p>Kelas 1</p><div class="progress progress-primary  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 35%"  aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><hr>
                                <p>Kelas 1</p><div class="progress progress-secondary  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div><hr>
                                <p>Kelas 1</p><div class="progress progress-warning  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div><hr>
                                <p>Kelas 1</p><div class="progress progress-danger  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div><hr>
                                <p>Kelas 1</p><div class="progress progress-dark  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div><hr>
                                <p>Kelas 1</p><div class="progress progress-info  mb-4">
                                    <div class="progress-bar progress-label" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div><hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
</div>
@endsection
@section('sidebar')
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header text-center">
            <img src="{{  Session::get('is_google') == 0 ? asset(Session::get('foto_profil')) : Session::get('foto_profil') }}" class="" alt="" srcset="">
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
