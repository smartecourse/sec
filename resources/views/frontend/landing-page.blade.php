@extends('frontend.layouts.template') @section('content')
<section class="mt-5 mb-5">
   <div class="row">
      <div class="col-lg-6 d-flex flex-wrap align-content-center">
         <div class="slideRight">
            <h1 class="title-text-big">
               Belajar mudah<br class="d-lg-block d-none" />
               <span style="color: #4E91F9">Tingkatkan Skill</span> dengan<br
                  class="d-lg-block d-none"
                  />
               Smart Course English
            </h1>
         </div>
         <div class="pt-2 slideRight">
            <p class="text-caption">
               Hard to find a good mentor according to your wishes?<br
                  class="d-sm-block d-none"
                  />Don't worry because we are here to help you
            </p>
         </div>
      </div>
      <div class="col-lg-6 mt-5">
         <img
            src=" {{ asset('frontend/assets/ilustrasi/header-1.png') }}"
            alt=""
            class="img-fluid"
            />
      </div>
   </div>
</section>
<!-- <section> begin  mengapa kami============================-->
<section class="pt-md-6" style="margin-top: 150px" id="kelas">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-5 col-lg-7 text-lg-center">
            <img
               class="img-fluid mb-5 mb-md-0"
               src=" {{ asset('frontend/assets/ilustrasi/header-2.png') }} "
               alt=""
               />
         </div>
         <div class="col-md-7 col-lg-5 text-center text-md-start">
            <h1 class="title-text-big p-0 m-0">Kenapa Harus Kami ?</h1>
            <hr class="mb-5" width="50%" />
            <p>
               You can explore the features that we provide with fun and have their
               own functions each feature.
            </p>
            <div class="d-flex">
               <svg
                  class="bi bi-check-circle-fill"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="#2FAB73"
                  viewBox="0 0 16 16"
                  >
                  <path
                     d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                     ></path>
               </svg>
               <p class="ms-2">Powerfull online protection.</p>
            </div>
            <div class="d-flex">
               <svg
                  class="bi bi-check-circle-fill"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="#2FAB73"
                  viewBox="0 0 16 16"
                  >
                  <path
                     d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                     ></path>
               </svg>
               <p class="ms-2">Internet without borders.</p>
            </div>
            <div class="d-flex">
               <svg
                  class="bi bi-check-circle-fill"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="#2FAB73"
                  viewBox="0 0 16 16"
                  >
                  <path
                     d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                     ></path>
               </svg>
               <p class="ms-2">Supercharged VPN.</p>
            </div>
            <div class="d-flex">
               <svg
                  class="bi bi-check-circle-fill"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="#2FAB73"
                  viewBox="0 0 16 16"
                  >
                  <path
                     d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                     ></path>
               </svg>
               <p class="ms-2">Internet without borders.</p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- <section> close mengapa kami============================-->
<!-- <section> begin paket kelas ============================-->
<section class="bg-100 py-7" style="margin-top: 200px" id="kelas">
   <div class="container-lg">
      <div class="row justify-content-center">
         <div class="col-md-8 col-lg-5 text-center mb-3">
            <h2 class="title-text-big" id="belajar" style="visibility: hidden;">
               #SemuaBisaBelajar
            </h2>
            <p class="text-caption text-center">
               Akses semua kelas berkualitas tinggi dengan harga terjangkau di
               <strong>Smart Course</strong>.
            </p>
         </div>
      </div>
      <div class="row h-100 justify-content-center">
         @foreach ($paket as $item)
         <div class="col-md-6 pt-4 px-md-2 px-lg-6" id="{{ strtolower($item->nama_jenis_kelas) }}">
            <div class="card card shadow-sm p-3 rounded bg-light" style="border: none">
               <div class="card-body d-flex flex-column justify-content-around p-5">
                  <div class="">
                      @if (strtolower($item->nama_jenis_kelas) == 'private')
                      <img
                      class="img-fluid"
                      src=" {{ asset('frontend/assets/icon/private-icon.png') }}"
                      alt=""
                      />
                      @elseif(strtolower($item->nama_jenis_kelas) == 'reguler')
                      <img
                         class="img-fluid"
                         src="{{ asset('frontend/assets/icon/regular-icon.png') }}"
                         alt=""
                         />
                      @else
                      <img
                         class="img-fluid"
                         src="{{ asset('frontend/assets/icon/regular-icon.png') }}"
                         alt=""
                         />
                      @endif
                  </div>
                  <h4 class="text-paket">{{ $item->nama_jenis_kelas }}</h4>
                  <p class="">{{ \Illuminate\Support\Str::limit($item->deskripsi_jenis, 250, $end='...') }}</p>
                  <hr class="regular-hr m-0" />
                  {{-- Item Fasilitas --}}
                  @php
                      $fasilitas = \App\Models\Fasilitas::where('id_paket', $item->id)->get();
                  @endphp
                  @foreach ($fasilitas as $value)
                  <div class="d-flex mt-4">
                     <svg
                        class="bi bi-check-circle-fill"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="#2FAB73"
                        viewBox="0 0 16 16"
                        >
                        <path
                           d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                           ></path>
                     </svg>
                     <p class="ms-2">{{ $value->fasilitas }}</p>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
   <!-- end of .container-->
</section>
<!-- <section> close paket kelas ============================-->
@endsection
@section('download')
<!-- <section> begin ============================-->
<section class="py-5 z-index-1 section-download">
   <div class="container">
      <div class="card py-5 px-5 border-0 shadow bg-light">
         <div class="card-body">
            <div class="row flex-center">
               <div class="col-12 col-lg-6 text-lg-start">
                  <h2 class="text-700 ">
                     Subscribe Now for <br />Get Special Features!
                  </h2>
                  <p class="mb-lg-0">Let's subscribe with us and find the fun.</p>
               </div>
               <div class="col-12 col-lg-6 text-lg-end">
                  <a class="btn btn-fill text-white" href="#">Unduh Sekarang</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end of .container-->
</section>
<!-- <section> close ============================-->
@endsection
