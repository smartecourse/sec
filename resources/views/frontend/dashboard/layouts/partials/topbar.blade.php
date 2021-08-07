<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-none d-md-block d-lg-inline-block">Hi, {{ Session::get('nama') }}</div>
                    <div class="avatar mr-1">
                        @if (Session::get('is_google') == 1 )
                            <img src=" {{ Session::get('foto_profil') != null ? Session::get('foto_profil') : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid login-img" alt="">
                        @else
                            <img src=" {{ Session::get('foto_profil') != null ? asset('upload/fotoProfil/'.Session::get('foto_profil')) : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid login-img" alt="">
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('landing-page') }}"><i data-feather="home"></i>Beranda</a>
                    <a class="dropdown-item" href="{{ route('profil.edit', Session::get('id_user')) }}"><i data-feather="user"></i>Profil</a>
                    <div class="dropdown-divider"></div>
                    {{-- <form action="{{ url('user-logout') }}" method="post"> --}}
                        {{-- @csrf --}}
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutUser"><i data-feather="log-out"></i>Keluar</a>
                    {{-- </form> --}}
                </div>
            </li>
        </ul>
    </div>
</nav>
{{-- <nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar mr-1">
                        <img src="{{ asset('frontend/assets/images/avatar/avatar-s-1.png') }}" alt="" srcset="">
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">{{ Session::get('nama') }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i data-feather="home"></i> Beranda</a>
                    <a class="dropdown-item" href="{{ route('edit-profil') }}"><i data-feather="user"></i> Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav> --}}
