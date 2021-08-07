@extends('frontend.layouts.template')
@section('content')
    <section class="bg-100 py-700" id="kelas">
        {{-- <div class="container text-center m-4"> --}}
            <div class="row mt-5 ">
                <div class="col-md-7 mb-3">
                    <div class="intro-detail h-100">
                        <div class="ratio ratio-16x9 plyr__video-embed " id="player">
                            {{-- <video src="{!! $kelas->intro_link !!}" autoplay></video> --}}
                            {!! $kelas[0]->intro_link !!}
                            {{-- <iframe src="{{ $kelas->intro_link.'?autoplay=1' }}" title="YouTube video" allowfullscreen allowtransparency allow="autoplay" id="youtube_intro" ></iframe> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="content-kelas h-100 position-relative box bg-primary" style="background-color: #fff !important; margin: 0 auto;">
                        {{-- <span class="position-absolute top-2 end-0 p-2 badge rounded-pill bg-warning discount" style="font-size: 12px">Diskon : {{ $kelas->diskon }} %</span> --}}
                        @if ($kelas[0]->diskon)
                        <div class="ribbon ribbon-top-right"><span>Diskon {{ $kelas[0]->diskon }} %</span></div>
                        @endif
                        <br>
                        <div class="mt-lg-2">
                            <h4 class="card-title">{{ $kelas[0]->judul_kelas }}</h4>
                            <p>{{ $kelas[0]->nama_paket }}</p>
                        </div>
                        <div>
                            <div class="badge rounded-pill card-detail-kategori mb-4">
                                <h1>{{ ucwords($kelas[0]->nama_jenis_kelas) }}</h1>
                            </div>
                        </div>
                        <div class="author mt-5 d-flex justify-content-start">
                            <div class="">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746" fill="#012966"/>
                                    <path opacity="0.4" d="M11.9971 12.5837C14.9351 12.5837 17.2891 10.2287 17.2891 7.2917C17.2891 4.3547 14.9351 1.9997 11.9971 1.9997C9.06008 1.9997 6.70508 4.3547 6.70508 7.2917C6.70508 10.2287 9.06008 12.5837 11.9971 12.5837" fill="#012966"/>
                                </svg>
                            </div>
                            <div class="d-flex " style="padding-top:4px ">
                                <p style="padding-right: 5px;" class="author">Oleh : </p>
                                <strong class="author">{{ $kelas[0]->by_author }}</strong>
                            </div>
                        </div>
                        <div class="deadline mt-3 d-flex justify-content-start">
                            <div style="padding-right: 5px">
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 14.87V7.257H18V14.931C18 18.07 16.0241 20 12.8628 20H5.12733C1.99561 20 0 18.03 0 14.87ZM4.95938 12.41C4.50494 12.431 4.12953 12.07 4.10977 11.611C4.10977 11.151 4.46542 10.771 4.91987 10.75C5.36443 10.75 5.72997 11.101 5.73985 11.55C5.7596 12.011 5.40395 12.391 4.95938 12.41ZM9.01976 12.41C8.56531 12.431 8.1899 12.07 8.17014 11.611C8.17014 11.151 8.5258 10.771 8.98024 10.75C9.42481 10.75 9.79034 11.101 9.80022 11.55C9.81998 12.011 9.46432 12.391 9.01976 12.41ZM13.0505 16.09C12.596 16.08 12.2305 15.7 12.2305 15.24C12.2206 14.78 12.5862 14.401 13.0406 14.391H13.0505C13.5148 14.391 13.8902 14.771 13.8902 15.24C13.8902 15.71 13.5148 16.09 13.0505 16.09ZM8.17014 15.24C8.1899 15.7 8.56531 16.061 9.01976 16.04C9.46432 16.021 9.81998 15.641 9.80022 15.181C9.79034 14.731 9.42481 14.38 8.98024 14.38C8.5258 14.401 8.17014 14.78 8.17014 15.24ZM4.09989 15.24C4.11965 15.7 4.49506 16.061 4.94951 16.04C5.39407 16.021 5.74973 15.641 5.72997 15.181C5.72009 14.731 5.35456 14.38 4.90999 14.38C4.45554 14.401 4.09989 14.78 4.09989 15.24ZM12.2404 11.601C12.2404 11.141 12.596 10.771 13.0505 10.761C13.4951 10.761 13.8507 11.12 13.8705 11.561C13.8804 12.021 13.5247 12.401 13.0801 12.41C12.6257 12.42 12.2503 12.07 12.2404 11.611V11.601Z" fill="#012966"/>
                                    <path opacity="0.4" d="M0.00341797 7.2569C0.016261 6.6699 0.0656573 5.5049 0.158522 5.1299C0.632726 3.0209 2.24304 1.6809 4.54491 1.4899H13.456C15.7381 1.6909 17.3682 3.0399 17.8424 5.1299C17.9343 5.4949 17.9837 6.6689 17.9965 7.2569H0.00341797Z" fill="#012966"/>
                                    <path d="M5.30465 4.59C5.73934 4.59 6.06535 4.261 6.06535 3.82V0.771C6.06535 0.33 5.73934 0 5.30465 0C4.86996 0 4.54395 0.33 4.54395 0.771V3.82C4.54395 4.261 4.86996 4.59 5.30465 4.59Z" fill="#012966"/>
                                    <path d="M12.6948 4.59C13.1196 4.59 13.4555 4.261 13.4555 3.82V0.771C13.4555 0.33 13.1196 0 12.6948 0C12.2601 0 11.9341 0.33 11.9341 0.771V3.82C11.9341 4.261 12.2601 4.59 12.6948 4.59Z" fill="#012966"/>
                                </svg>
                            </div>
                            <div class="d-flex" style="padding-top:3px ">
                                <p style="padding-right: 5px;" class="author pr-4"> Deadline : </p>
                                <strong class="author">{{ $kelas[0]->deadline }} Hari</strong>
                            </div>
                        </div>
                        <div class="deadline mt-3 d-flex justify-content-start">
                            <div style="padding-right: 5px">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                    <path d="M19.25 0H13.25C12.838 0 12.261 0.239 11.97 0.53L4.53103 7.969C4.39076 8.10992 4.31201 8.30067 4.31201 8.4995C4.31201 8.69833 4.39076 8.88907 4.53103 9.03L10.97 15.469C11.111 15.6093 11.3017 15.688 11.5005 15.688C11.6994 15.688 11.8901 15.6093 12.031 15.469L19.47 8.03C19.762 7.738 20 7.162 20 6.75V0.75C19.9995 0.55125 19.9203 0.360791 19.7798 0.220253C19.6392 0.079715 19.4488 0.000527891 19.25 0V0ZM15.5 6C15.303 5.99993 15.1079 5.96106 14.9258 5.88559C14.7438 5.81012 14.5784 5.69954 14.4392 5.56016C14.2999 5.42078 14.1894 5.25533 14.1141 5.07325C14.0387 4.89118 14 4.69605 14 4.499C14.0001 4.30195 14.039 4.10685 14.1144 3.92482C14.1899 3.7428 14.3005 3.57742 14.4399 3.43813C14.5792 3.29884 14.7447 3.18837 14.9268 3.11303C15.1088 3.03768 15.304 2.99893 15.501 2.999C15.899 2.99913 16.2806 3.15735 16.5619 3.43884C16.8432 3.72033 17.0012 4.10204 17.001 4.5C17.0009 4.89796 16.8427 5.27956 16.5612 5.56087C16.2797 5.84217 15.898 6.00013 15.5 6V6Z" fill="#012966"/>
                                    <path d="M2.00003 8.5L10.5 0H9.25003C8.83803 0 8.26103 0.239 7.97003 0.53L0.531026 7.969C0.390758 8.10992 0.312012 8.30067 0.312012 8.4995C0.312012 8.69833 0.390758 8.88907 0.531026 9.03L6.97003 15.469C7.11095 15.6093 7.30169 15.688 7.50053 15.688C7.69936 15.688 7.8901 15.6093 8.03103 15.469L8.50103 14.999L2.00103 8.499L2.00003 8.5Z" fill="#8A99B2"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0">
                                    <rect width="20" height="16" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="d-flex" style="padding-top:3px ">
                                <p style="padding-right: 5px;" class="author pr-4"> Harga : </p>
                                @if ($kelas[0]->diskon > 0)
                                @php
                                    $nowPrice = $kelas[0]->harga - ($kelas[0]->harga * $kelas[0]->diskon / 100);
                                @endphp
                                <span class="text-muted" style="text-decoration: line-through;">Rp.{{ number_format($kelas[0]->harga, 2, ',', '.') }}</span>&nbsp;
                                <strong class="author">Rp.{{ number_format($nowPrice, 2, ',', '.') }}</strong>
                                @else
                                <strong class="author">Rp.{{ number_format($kelas[0]->harga, 2, ',', '.') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="footer-group">
                            <a href="{{ url('checkout/'.$kelas[0]->paket_slug) }}"  class="btn label ">Gabung Kelas</a>
                            {{-- <button type="submit" class="btn btn-primary w-100">Gabung Kelas</button> --}}
                        </div>
                    </div>
                </div>
            </div>
           @if ($kelas[0]->tipe_kelas == 'ebook')
                <div class="row p-4">
                    <h4 class="card-title">Intro Kelas</h4>
                    <div class="col-lg-12 intro">
                        {!! $kelas[0]->intro !!}
                    </div>
                </div>
           @endif
            <div class="row mt-5">
                <div class="container-fluid p-4">
                    <h4 class="card-title">Deskripsi Kelas</h4>
                    <div class="col-lg-12 intro">
                        {{ $kelas[0]->deskripsi }}
                        {{-- {!! $kelas[0]->intro !!} --}}
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title">Fasilitas Kelas</h4>
                            @foreach($fasilitas as $items)
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
                                <p class="ms-2">{{ $items->fasilitas }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <nav>
                            <ul class="nav nav-tabs">
                                @foreach ($kelas as $item)
                                <li class="nav-item">
                                    <a class="nav-link {{ strtolower($item->tipe_kelas) == 'video' ? 'active' : '' }}" data-bs-toggle="tab" href="#{{ strtolower($item->tipe_kelas) }}">{{ ucwords($item->tipe_kelas) }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container">
            <div class="row">
                    <div class="tab-content">
                        @foreach ($kelas as $item)
                        <div class="tab-pane fade show {{ $item->tipe_kelas == 'video' ? 'active' : '' }}" id="{{ $item->tipe_kelas }}">
                            <ul class="list-group list-group-flush">
                                @php
                                    $konten = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                                ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                                ->where('materi.kelas_id', $item->id_kelas)
                                                                ->where('kelas.tipe_kelas', $item->tipe_kelas)
                                                                ->get();
                                @endphp
                                @forelse ($konten as $kontenItem)
                                    @php
                                        $materikonten = \App\Models\MateriKonten::where('materi_id', $kontenItem->id)
                                                                                ->orderBy('urutan')
                                                                                ->get();
                                    @endphp
                                    <li class="list-group-item">
                                        <p class="list-materi p-0 m-0">{{ $kontenItem->nama_materi }}</p>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($materikonten as $materiItem)
                                                <li class="list-group-item">
                                                    <div class="d-flex">
                                                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.2688 6.71384H12.7312C15.0886 6.71384 17 8.58304 17 10.8885V15.8253C17 18.1308 15.0886 20 12.7312 20H4.2688C1.91136 20 0 18.1308 0 15.8253V10.8885C0 8.58304 1.91136 6.71384 4.2688 6.71384ZM8.49492 15.3295C8.99283 15.3295 9.38912 14.9419 9.38912 14.455V12.2489C9.38912 11.7719 8.99283 11.3844 8.49492 11.3844C8.00717 11.3844 7.61088 11.7719 7.61088 12.2489V14.455C7.61088 14.9419 8.00717 15.3295 8.49492 15.3295Z" fill="#012966"/>
                                                        <path opacity="0.4" d="M14.023 5.39595V6.86667C13.6673 6.7673 13.2913 6.71761 12.9052 6.71761H12.2447V5.39595C12.2447 3.37868 10.5681 1.73903 8.50533 1.73903C6.44257 1.73903 4.76594 3.36874 4.75578 5.37608V6.71761H4.10545C3.70916 6.71761 3.33319 6.7673 2.97754 6.87661V5.39595C2.9877 2.41476 5.45692 0 8.48501 0C11.5537 0 14.023 2.41476 14.023 5.39595" fill="#012966"/>
                                                        </svg>
                                                        <p class="list-materi-detail">{{ $materiItem->judul_konten_materi }}</p>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                    </li>
                                @empty
                                <p class="m-4">Belum ada materi.</p>
                                @endforelse
                            </ul>
                        </div>
                        @endforeach
                    
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row pt-4">
                    <h4 class="card-title p-2">Ulasan Pengguna</h4>
                    <div class="col-lg-12 intro">
                        <div class="content-kelas h-100 bg-primary" style="background-color: #fff !important; margin: 0 auto;">
                            <div class="review-kelas p-2">
                                <div class="row">
                                    @forelse ($review as $reviewKelas)
                                        <div class="mb-4">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 d-flex justify-content-center">
                                                    <div>
                                                        <img src=" {{ $reviewKelas->foto_profil != null ? asset('upload/fotoProfil/'.$reviewKelas->foto_profil) : 'https://ui-avatars.com/api/?format=svg&size=220&length=2' }} " class="img-fluid rounded" alt="User Akun" > 
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-12">
                                                    <h4 class="card-title p-0 m-0">{{ $reviewKelas->nama }}</h4>
                                                    <div class="d-flex justify-content-start mt-2" >
                                                        <div class="" style="margin-right: 10px !important">
                                                            <div class="d-flex justify-content-start">
                                                                <div class="star-review">
                                                                    @php
                                                                        $limit = 5;
                                                                    @endphp
                                                                    @for ($i = 1; $i <= $reviewKelas->rating; $i++)
                                                                        <span class="fa fa-star text-warning"></span>
                                                                        @php
                                                                            $limit--;
                                                                        @endphp
                                                                    @endfor
                                                                    @for ($i = 1; $i <= $limit; $i++)
                                                                        <span class="fa fa-star text-secondary"></span>
                                                                    @endfor                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <span class="text-secondary text-muted">{{ date('D, d-M-Y H:m:s', strtotime($reviewKelas->created_at)) }}</span>
                                                        </div>
                                                    </div>
                                                    <p class="pt-4">{{ $reviewKelas->review }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <hr class="" style="border: 1px solid #dee2e6">
                                        </div>
                                    @empty
                                        
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
