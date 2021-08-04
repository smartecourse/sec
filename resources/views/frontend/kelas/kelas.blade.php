@extends('frontend.layouts.template')
@section('content')
<section class="bg-100 py-700" id="kelas">
    <div class="container-lg text-center title-text-big">
        <h2 class=" mb-0 pb-0  title-text-big" style="">Katalog Kelas</h2>
        <hr class="mx-auto" style="width: 15%">
        <p class="text-caption text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>
</section>
<div class="katalog-kelas py-5 mb-5">
    <div class="container-lg">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm bg-body p-5 mb-5 mx-auto">
                    <div class=""><img class="img-fluid" src="{{ asset('frontend/assets/icon/regular-icon.png') }}" alt="" />
                    </div>
                    <h2 class="card-title pt-4">Regular</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum sunt perferendis molestiae deleniti autem odit nobis. Obcaecati sed nesciunt,</p>
                    {{-- <div class="d-flex justify-content-end">
                        <a href="" class="action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm bg-body p-5 mb-5 mx-auto" style="border: none">
                    <div class=""><img class="img-fluid" src="{{ asset('frontend/assets/icon/private-icon.png') }}" alt="" />
                    </div>
                    <h2 class="card-title pt-4">Private</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum sunt perferendis molestiae deleniti autem odit nobis. Obcaecati sed nesciunt,</p>
                    {{-- <div class="d-flex justify-content-end">
                        <a href="" class="action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12 col-md-6 ms-2 mb-4">
                <h4 class="card-title">Semua Kelas</h4>
                {{-- <hr class="" width="15%"> --}}
            </div>
        </div>
        {{-- <div class="row mb-4">
            <div class="col-lg-8">
                <form action="">
                    <div class="search"> <input type="text" class="search-input" placeholder="Belajar Apa Hari Ini ?" name=""> <i class="fa fa-search search-icon"></i></div>
                </form>
            </div>
        </div> --}}
        <div class="row">
            @foreach ($paket as $items)
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm bg-body p-3 mb-5 " style="position: relative;">
                    <a href="{{ url('detail-kelas/'.$items->slug) }}" class="card-title">
                        <div class="position-relative">
                            <img src=" {{ $items->cover != null ? asset( $items->cover) : ' <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>'}}" class="img-fluid katalog-semua" alt="">
                            <span class="position-absolute top-50 start-50 translate-middle badge bg-primary " style="font-size: 12px; opacity: 0.6;">{{ $items->nama_jenis_kelas }}</span>
                            <h2 class="card-title mt-3">{{ ucwords($items->nama_paket) }}</h2>
                        </div>
                    </a>
                    <div class="text-harga">
                        @if ($items->diskon > 0)
                        <span class="text-muted">Rp{{ number_format($items->harga,2, ',', '.') }}</span>
                        @php
                            $diskon = $items->harga * ($items->diskon / 100);
                            $nowPrice = $items->harga - $diskon;
                        @endphp
                        <span class="text-success pulse">Rp{{ number_format($nowPrice,2, ',', '.') }}</span><span class="position-absolute top-0 start-0 p-2 badge rounded-pill bg-warning" style="font-size: 14px; font-weight:400">Diskon : {{ $items->diskon }} %</span>
                        @else
                            <span class="text-success pulse">Rp{{ number_format($items->harga,2, ',', '.') }}</span>
                        @endif
                    </div>
                    <hr class="regular-hr m-0 mt-3" />
                    <div class="">
                        {{-- Item Fasilitas --}}
                        @php
                        $fasilitas = \App\Models\Fasilitas::where('id_paket', $items->id)->get();
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
        {{-- <div class="row m-5">

            <div class="col-lg-12 d-flex justify-content-center">
                {!! $paket->links() !!}
            </div>
        </div> --}}
    </div>

</div>
@endsection
