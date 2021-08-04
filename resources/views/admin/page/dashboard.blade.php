@extends('admin.core.core-dashboard')
@section('onPage', 'Dashboard')
@section('onPage', 'Materi')
@section('extraCSS')
    <style>
        .custom-shake{
        animation: shake 0.5s;
        animation-iteration-count: infinite;
    }
    @keyframes shake {
        0% { transform: translate(1px, 1px) rotate(0deg); }
        10% { transform: translate(-1px, -2px) rotate(-1deg); }
        20% { transform: translate(-3px, 0px) rotate(1deg); }
        30% { transform: translate(3px, 2px) rotate(0deg); }
        40% { transform: translate(1px, -1px) rotate(1deg); }
        50% { transform: translate(-1px, 2px) rotate(-1deg); }
        60% { transform: translate(-3px, 1px) rotate(0deg); }
        70% { transform: translate(3px, 1px) rotate(-1deg); }
        80% { transform: translate(-1px, -1px) rotate(1deg); }
        90% { transform: translate(1px, 2px) rotate(0deg); }
        100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User (Pengguna)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getUsers}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User (Admin)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getAdmin}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kelas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getKelas}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-school fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Transaksi (Berhasil)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getTransaksiSuccess}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Transaksi (Proses)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getTransaksiProcess}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-bell fa-2x text-gray-300 @if ($getTransaksiProcess != 0)  @endif"></i>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection