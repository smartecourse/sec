@extends('frontend.dashboard.layouts.template')
@section('dashboard-css')<link rel="stylesheet" href="{{ asset('frontend/assets/css/app.css') }}">@endsection
@section('content')
<div class="main-content container-fluid">
   <section class="section">
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible show fade">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Profil Saya</h4>
         </div>
         <div class="card-content">
            <div class="card-body">
               <div class="row">
                  <form class="form form-vertical" action="{{ route('profil.update', $profil->id) }}" method="POST"  class="needs-validation" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                     <div class="form-body">
                        <div class="row">
                           <div class="col-12">
                              <div class="form-group">
                                 <label for="pilih-foto-vertical">Pilih foto :</label><br>
                                 <img src="{{ $profil->foto_profil }}" alt="">
                                 <input type="file" name='foto' class="form-control @error('foto') is-invalid @enderror">
                                 @if ($errors->has('foto'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('foto') }}
                                    </div>
                                 @endif
                              </div>
                           </div>
                           <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-vertical">Nama Lengkap</label>
                                <input type="text" id="first-name-vertical" class="form-control @error('name') is-invalid @enderror" autofocus name="name"
                                    placeholder="Nama Lengkap" value="{{ $profil->nama }}">
                                <span class="text-muted" style="font-size: 12px">Ex : Ageng Wijaya</span>
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                                </div>
                                @endif
                              </div>
                           </div>
                           <div class="col-12">
                              <div class="form-group">
                                <label for="email-id-vertical">Email</label>
                                <input type="email" id="email-id-vertical" class="form-control @error('email') is-invalid @enderror" autofocus name="email"
                                    placeholder="Email" value="{{ $profil->email }}">
                                <span class="text-muted" style="font-size: 12px">Ex : agengwijaya@gmail.com</span>
                                @if ($errors->has('email'))
                                  <div class="invalid-feedback">
                                  {{ $errors->first('email') }}
                                  </div>
                                @endif
                              </div>
                           </div>
                           <div class="col-12">
                              <div class="form-group">
                                <label for="contact-info-vertical">No. HP</label>
                                <input type="" id="contact-info-vertical" class="form-control @error('no_hp') is-invalid @enderror" autofocus name="no_hp"
                                    placeholder="No. HP" value="{{ $profil->phone }}">
                                <span class="text-muted" style="font-size: 12px">Ex : 085724662666</span>
                                @if ($errors->has('no_hp'))
                                <div class="invalid-feedback">
                                {{ $errors->first('no_hp') }}
                                </div>
                                @endif
                              </div>
                           </div>
                           <div class="col-12">
                              <div class="form-group">
                                 <label for="password-vertical">Bio</label>
                                 <textarea id="contact-info-vertical" class="form-control @error('bio') is-invalid @enderror" autofocus name="bio"
                                    placeholder="Bio">{{ $profil->tentang_saya }}</textarea>
                                @if ($errors->has('bio'))
                                <div class="invalid-feedback">
                                {{ $errors->first('bio') }}
                                </div>
                                @endif
                              </div>
                              <div class="col-12 d-flex justify-content-end">
                                 <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                 <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
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
