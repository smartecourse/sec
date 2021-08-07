@extends('frontend.dashboard.layouts.template')
@section('dashboard-css')<link rel="stylesheet" href="{{ asset('frontend/assets/css/app.css') }}">@endsection
@section('content')
<div class="main-content container-fluid">
    <section class="section">
        <div class="card-header">
            <h3>Transaksi</h3>
        </div>
        <div class="card collapse-icon accordion-icon-rotate">
            <div class="card-content">
                <div class="card-body">
                    <div class="accordion" id="cardAccordion">
                        <div class="card">
                            <div class="card-header" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="false" aria-controls="collapseOne" role="button">
                                <h5>Riwayat Transaksi</h5>
                                <hr>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table-transaksi">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelas</th>
                                            <th>Diskon</th>
                                            <th>Harga</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->kode_transaksi }}</td>
                                                <td>{{ ucwords($item->nama_paket) }}</td>
                                                <td>{{ ucwords($item->nama_jenis_kelas) }}</td>
                                                <td>{{ $item->diskon > 0 ? $item->diskon.'%' : '-' }}</td>
                                                <td>Rp.{{ number_format($item->grand_total, 2, '.', ',') }}</td>
                                                <td>{{ $item->metode_pembayaran == null ? '-' : $item->metode_pembayaran }}</td>
                                                <td>{{ ucwords($item->status) }}</td>
                                                <td>{{ date("Y-m-d", strtotime($item->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
