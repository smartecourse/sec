
<header>
    <nav class="navbar-top navbar navbar-expand-lg navbar-light fixed-top " id="startchange">
        <!-- <a href="#"> -->
          <strong>Smart Course</strong>
        <!-- </a> -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal" data-bs-target="#targetModal-item">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarTogglerDemo">
          <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item {{ request()->routeIs('landing-page') ? 'active' : ''}} position-relative">
              <a class="nav-link main=" style="color: {{ request()->routeIs('landing-page') ? '#243142;' : ''}} " href="{{ route('landing-page') }}">Beranda</a>
            </li>
            <li class="nav-item {{ request()->routeIs('katalog-kelas') || request()->routeIs('detail-kelas') ? 'active' : ''}} position-relative">
              <a class="nav-link" href=" {{ route('katalog-kelas') }} " style=" color: {{ request()->routeIs('katalog-kelas') ? '#243142' : '' }} ">Kelas</a>
            </li>
            <li class="nav-item {{ request()->routeIs('tentang-kami') ? 'active' : ''}}  position-relative">
              <a class="nav-link" href="{{ route('tentang-kami') }}" style="color:{{ request()->routeIs('tentang-kami') ? '#243142;' : ''}} " >Tentang Kami</a>
            </li>
          </ul>
          @if (Session::has('token'))
            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center">
                    <div class="p-2 login-text">
                        <a href="{{ url('dashboard') }}">
                            <strong class="">Hallo, {{ Session::get('nama') }}</strong>
                    </div>
                    <div style="margin-right: 10px !important;">
                        {{-- {{ Session::get('is_google') }} --}}
                            <img src=" {{ asset(Session::get('foto_profil')) }} " class="img-fluid login-img" alt="">
                        </a>
                    </div>
                    {{-- <form action="{{ url('user-logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger text-white">Logout</button>
                    </form> --}}
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="darkSwitch" />
                        <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                    </div>
                </div>
            </div>
          @else
            <div style="margin-right: 10px !important;">
                <a href=" {{ route('login-front') }} ">
                    <button class="btn btn-default btn-no-fill">Masuk</button>
                </a>
            </div>
            <div class=""style="margin-right: 10px !important;">
                <a href=" {{ route('register-process') }} ">
                    <button class="btn btn-fill text-white">Daftar</button>
                </a>
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="darkSwitch" />
                <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
            </div>
          @endif
        </div>
    </nav>
      <!-- END NAVIGATION TOPBAR -->

    <!-- Modal Mobile -->
    <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog" aria-labelledby="targetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white border-0">
                <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                <a class="modal-title" id="targetModalLabel">
                  <strong>Smart Course</strong>
                    {{-- <img style="margin-top: 0.5rem"
                    src=""
                    alt="" /> --}}
                </a>
                <button type="button" class="close btn-close text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0 ">
                    <li class="nav-item {{ request()->routeIs('landing-page') ? 'active' : ''}} position-relative ">
                    <a class="nav-link main" style="color:{{ request()->routeIs('landing-page') ? '#243142;' : ''}}" href="{{ route('landing-page') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('katalog-kelas') || request()->routeIs('detail-kelas') ? 'active' : ''}} position-relative">
                    <a class="nav-link" style="color: {{ request()->routeIs('katalog-kelas') ? '#243142' : '' }}" href="{{ route('katalog-kelas') }}">Kelas</a>
                    </li>
                    <li class="nav-item  {{ request()->routeIs('tentang-kami') ? 'active' : ''}} position-relative">
                    <a class="nav-link" style="color:{{ request()->routeIs('tentang-kami') ? '#243142;' : ''}}" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                    </li>
                </ul>
                </div>
                <div class="modal-footer border-0" style="padding: 2rem; padding-top: 0.75rem">
                  @if (Session::has('token'))
                  <div class="d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                        <div class="p-2 login-text">
                            <a href="{{ url('dashboard') }}">
                                <strong class="">Hallo, {{ Session::get('nama') }}</strong>
                        </div>
                        <div style="margin-right: 10px !important;">
                            {{-- {{ Session::get('is_google') }} --}}
                                <img src=" {{ asset(Session::get('foto_profil')) }} " class="img-fluid login-img" alt="">
                            </a>
                        </div>
                        {{-- <form action="{{ url('user-logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger text-white">Logout</button>
                        </form> --}}
                        <div class="form-check form-switch">
                          <input type="checkbox" class="form-check-input" id="darkSwitch" />
                          <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                        </div>
                    </div>
                  </div>
                  @else
                  <a href=" {{ route('login-front') }} ">
                    <button class="btn btn-default btn-no-fill">Masuk</button>
                  </a>
                  <a href=" {{ route('register-process') }} ">
                    <button class="btn btn-fill text-white">Daftar</button>
                  </a>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="darkSwitch" />
                    <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal -->

     @include('frontend.layouts.partials.bottom-navbar')
</header>
