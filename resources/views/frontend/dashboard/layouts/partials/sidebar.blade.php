<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header text-center">
            <img src="{{ Session::get('foto_profil')  != null ? asset('upload/fotoProfil/'.Session::get('foto_profil')) : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }}"  class="" alt="" srcset="">
            <h3 class="text-user">{{ Session::get('nama') }}</h3>
            @if (Session::get('status') != 'regular')
                <span class="badge bg-info">{{ Session::get('status') }}</span>
            @else
                <span class="badge bg-info">{{ Session::get('status') }}</span>
            @endif
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class='sidebar-title'>Main Menu</li>

                <li class="sidebar-item {{Request::segment(2) == '' ? 'active' : ''}} ">
                    <a href="{{ url('/dashboard') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dasshboard</span>
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

                <li class="sidebar-item  ">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="layout" width="20"></i>
                        <span>Transaksi</span>
                    </a>

                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>

