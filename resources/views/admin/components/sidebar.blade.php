<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/master')}}">
        <div class="sidebar-brand-icon p-3 {{-- rotate-n-15 --}}">
        <i><img src="{{asset('image/logo/bmw.png')}}" style="width: 70%;" alt="Logo"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SEC Admin</div>
    </a>
    
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{Request::segment(2) == '' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Kelola Kelas
    </div>

    <li class="nav-item {{Request::segment(2) == 'paket' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/paket')}}">
        <i class="fas fa-fw fa-box-open"></i>
        <span>Paket</span></a>
    </li>

    <li class="nav-item {{Request::segment(2) == 'fasilitas-paket' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/fasilitas-paket')}}">
        <i class="fas fa-fw fa-sliders-h"></i>
        <span>Fasilitas Paket</span></a>
    </li>

    <li class="nav-item {{Request::segment(2) == 'kelas' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/kelas')}}">
        <i class="fas fa-fw fa-school"></i>
        <span>Kelas</span></a>
    </li>

    <li class="nav-item {{Request::segment(2) == 'jenis-kelas' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/jenis-kelas')}}">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Jenis Kelas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Kelola Materi
    </div>

    <li class="nav-item {{Request::segment(2) == 'materi' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/materi')}}">
        <i class="fas fa-fw fa-book"></i>
        <span>Materi</span></a>
    </li>

    <li class="nav-item {{Request::segment(2) == 'konten-materi' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/konten-materi')}}">
        <i class="fas fa-fw fa-book-open"></i>
        <span>Konten Materi</span></a>
    </li>

    {{-- <li class="nav-item {{Request::segment(2) == 'post-test-materi' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/post-test-materi')}}">
        <i class="fas fa-fw fa-pen-square"></i>
        <span>Post Test Materi</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Kelola Akun
    </div>

    <li class="nav-item {{Request::segment(2) == 'akun' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/akun')}}">
        <i class="fas fa-fw fa-user-cog"></i>
        <span>Akun</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Kelola Transaksi
    </div>

    <li class="nav-item {{Request::segment(2) == 'transaksi' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/transaksi')}}">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>Transaksi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Kebijakan Privasi
    </div>

    <li class="nav-item {{Request::segment(2) == 'kebijakan-privasi' ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/master/kebijakan-privasi')}}">
        <i class="fas fa-fw fa-gavel"></i>
        <span>Kebijakan Privasi</span></a>
    </li>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>