@extends('frontend.dashboard.layouts.template')
@section('dashboard-css')<link rel="stylesheet" href="{{ asset('frontend/assets/css/app.css') }}">@endsection
@section('content')
<div class="main-content container-fluid">
    <section class="section">
        <div class="card-header">
            <h3 style="font-weight: 600">Kelas Saya</h3>
        </div>
        <div class="card collapse-icon accordion-icon-rotate" >
            <div class="card-content">
                @forelse ($kelas as $item)
                <div class="card-body">
                    <div class="accordion" id="cardAccordion">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{ $item->paket_id }}"
                                aria-expanded="false" aria-controls="collapse{{ $item->paket_id }}" role="button">
                                <h5>Kelas</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 col-sm-0">
                                        <div class="card">
                                            <div class="card-content ">
                                                <img class="card-img img-fluid" src="{{ asset($item->cover) }}" alt="Card image">
                                                <div class="d-flex justify-content-between flex-column">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ ucwords($item->nama_paket) }}</h5>
                                            <p class="card-text"><small class="text-muted">{{ ucwords($item->nama_jenis_kelas) }}</small></p>
                                            <p class="card-text">{{ strlen($item->deskripsi) > 200 ? substr($item->deskripsi, 0, 200).'...' : $item->deskripsi }}</p>
                                        </div>
                                    </div>
                                    <i data-feather="chevron-down"></i>
                                </div>

                            </div>
                            @php
                                $kelas_item = \App\Models\Kelas::select('kelas.*', 'kelas_aktif.id as id_kelas_aktif')
                                                                    ->join('kelas_aktif', 'kelas_aktif.kelas_id', 'kelas.id')
                                                                    ->join('paket', 'paket.id', 'kelas.paket_id')
                                                                    ->where('paket.id', $item->paket_id)
                                                                    ->orderBy('kelas.tipe_kelas', 'DESC')
                                                                    ->get();
                                /* dd($kelas_item); */
                            @endphp
                            @foreach ($kelas_item as $item)
                            @php
                                $totalMateri = \App\Models\MateriKonten::select('materi_konten.id')
                                                                        ->join('materi', 'materi.id', 'materi_konten.materi_id')
                                                                        ->where('materi.kelas_id', $item->id)
                                                                        ->count();
                                                                        // echo $item->kelas_id;
                                $totalMateriSelesai = \App\Models\MateriKontenSelesai::select('id')->where('kelas_aktif_id', $item->id_kelas_aktif)->count();
                                /* dd($totalMateriSelesai); */
                                if($totalMateri > 0) {
                                    $progress = (100 / $totalMateri) * $totalMateriSelesai;
                                }
                                else {
                                    $progress = 0;
                                }
                                $progress = round($progress, 0);
                            @endphp
                            <div id="collapse{{ $item->paket_id }}" class="collapse pt-1" aria-labelledby="headingOne"
                            data-parent="#cardAccordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-content m-md-2">
                                                <img class="card-img img-fluid" src="{{ asset($item->cover) }}" alt="Card image">
                                                <div class="d-flex justify-content-between flex-column">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 mb-1">
                                        <p>{{ $item->judul_kelas.' - '.ucwords($item->tipe_kelas) }}</p>
                                        <p>{{ $totalMateriSelesai }} dari modul telah selesai</p><div class="progress progress-primary  mb-4">
                                            <div class="progress-bar progress-label" role="progressbar" style="width: {{ $progress }}%"  aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <a href="{{ url($item->tipe_kelas == 'video' ? 'dashboard/detail-kelas-aktif-video/'.$item->slug : 'dashboard/detail-kelas-aktif-ebook/'.$item->slug) }}">
                                            <button class="btn btn-primary block">Lanjutkan Belajar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                    <div class="card-body">
                        <div class="accordion" id="cardAccordion">
                            <span class="card-text">Anda belum pernah membeli kelas.</span>
                        </div>
                    </div>
                @endforelse()
            </div>
        </div>
    </section>
</div>
@endsection
@section('sidebar')
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header text-center">
            <img src="{{ asset(Session::get('foto_profil')) }}" class="" alt="" srcset="">
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
