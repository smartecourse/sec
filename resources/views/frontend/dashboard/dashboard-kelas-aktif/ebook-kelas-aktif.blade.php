@extends('frontend.dashboard.layouts.template')
@section('dashboard-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/app-detail.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection
@section('content')
@php
    $noMateri = 0;
    $noMateriTarget = 0;
    $materiLink = [];
    $totalMateri = \App\Models\MateriKonten::join('materi', 'materi.id', 'materi_konten.materi_id')
                                            ->where('materi.kelas_id', $kelas->id)
                                            ->count();
    // echo $totalMateri;
    // echo $kelas->id_kelas_aktif;
    $materiDone = \App\Models\MateriKontenSelesai::where('kelas_aktif_id', $kelas->id_kelas_aktif)->count();
    // echo $materiDone;
@endphp
@foreach ($materi as $item)
    @php
        $materiKonten = \App\Models\MateriKonten::where('materi_id', $item->id)
                                                ->orderBy('urutan')
                                                ->get();      
        /* dd($materiKonten);  */                                         
    @endphp
    @foreach ($materiKonten as $kontenItem)
        @php
            $noMateriTarget+=1;
            /* dd($kontenItem); */
            $materiSelesai = \App\Models\MateriKontenSelesai::select('id', 'materi_konten_id')
                                                            ->where('materi_konten_id', $kontenItem->id)
                                                            ->orderBy('updated_at', 'DESC')
                                                            ->get();
            $materiLink[] = ['/dashboard/detail-kelas-aktif-ebook/'.$kelas->slug.'/'.$kontenItem->slug.'/'.$kontenItem->urutan.'/'.$noMateriTarget];
        @endphp
    @endforeach
@endforeach

<div class="main-content container-fluid">
    <section class="section">
        <div class="alert alert-light-success color-success"><i data-feather="star"></i>Kelas dibeli pada tanggal : <strong>12 Mei 2021 </strong>.</div>
        <div class="d-flex justify-content-end bd-highlight mb-2">
            @if($materiDone == $totalMateri)
            <div class="p-2 bd-higlight">
                <button type="button" class="btn btn-success p-3"  data-toggle="modal" data-backdrop="true" data-target="#kelas-review">Beri Review Kelas</button>
            </div>
            <div class="p-2 bd-highlight">
                <a href="{{ asset($kelas->pdf_file) }}" class="btn icon icon-left btn-danger p-3 d-flex">
                    <i class="material-icons" style="font-size: 23px"> picture_as_pdf</i>
                    <p class="ml-2" style=" margin: 0"> Unduh File PDF</p>
                </a>
            </div>
            @endif
        </div>
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success sb-alert-icon m-3 w-100" role="alert">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="sb-alert-icon-content">
                        {{session('status')}}
                    </div>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger sb-alert-icon m-3 w-100" role="alert">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="sb-alert-icon-content">
                        {{session('error')}}
                    </div>
                </div>
            @endif
        </div>
        <div class="card shadow-sm p-3 mb-4 bg-white rounded">
            @if (isset($konten))
            <div class="card-header">
                <h3> <strong> {{ ucwords($konten->judul_konten_materi) }}</strong></h3>
                <hr>
            </div>
            <div class="card-body" style="line-height: 2rem">
                <div class="card-text">
                    {!! $konten->deskripsi !!}
                </div>
            </div>
            @else
            <div class="card-header">
                <h3> <strong> Dummy Content</strong></h3>
                <hr>
            </div>
            <div class="card-body" style="line-height: 2rem">
                <div class="card-text">
                    <p class="card-text">Dummy Content</p>
                </div>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-end bd-highlight mb-2">
            <div class="p-2 bd-highlight">
                <form action="{{ url('/dashboard/detail-kelas-aktif-ebook/'.$kelas->slug.'/'.$konten->slug.'/'.$konten->urutan) }}/check" method="POST">
                    @csrf
                    @if (count($materiLink) == Request::segment(6)[0])
                        <input type="hidden" name="segment" value="{{$materiLink[Request::segment(6) - 1][0]}}">
                    @else
                        <input type="hidden" name="segment" value="{{$materiLink[Request::segment(6)][0]}}">
                    @endif
                    <input class="btn icon icon-left btn-primary p-3" type="submit" value="Tandakan Selesai & Next Ebook">
                </form>
            </div>
        </div>

    </section>
</div>

@include('frontend.dashboard.dashboard-kelas-aktif.modal-review')
@endsection

@section('sidebar')
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="shadow-sm p-3 mb-5 bg-white rounded p-3 d-flex justify-content-start ">
           <div class="pt-2">
                <span class="material-icons">
                arrow_back
                </span>
           </div>
           <div class="p-2">
               <a href="{{ url('/dashboard/kelas-saya') }}">Kembali Ke Beranda</a>
           </div>
        </div>
        <div class="sidebar-header text-center d-flex">
            <div>
                <svg width="100" height="120" viewBox="0 0 115 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Group 6926">
                    <path id="Vector" d="M0.361359 26.5728L0 0L93.1438 7.89401L95.7845 31.6039L0.361359 26.5728Z" fill="#263238"/>
                    <path id="Vector_2" d="M10.6181 27.1287C9.74175 22.8209 9.32246 18.4327 9.36721 14.0369C8.96856 9.65914 9.04312 5.25124 9.58958 0.889496C10.4688 5.19648 10.8788 9.58601 10.8126 13.9813C11.2313 18.3576 11.1661 22.7667 10.6181 27.1287Z" fill="#455A64"/>
                    <path id="Vector_3" d="M14.1203 1.19522C14.9345 5.49031 15.2701 9.86243 15.1209 14.2315C15.4718 18.5981 15.3226 22.9905 14.6762 27.3233C13.8774 23.0168 13.542 18.6372 13.6755 14.2593C13.3418 9.90154 13.491 5.5202 14.1203 1.19522V1.19522Z" fill="#455A64"/>
                    <path id="Vector_4" d="M22.5981 13.0085C38.8309 14.7874 57.8989 15.7881 74.4096 17.289Z" fill="white"/>
                    <path id="Vector_5" d="M74.4096 17.1778C71.8718 17.3596 69.3229 17.3131 66.7935 17.0389C62.0682 16.8165 55.6752 16.3996 48.4483 15.8714C41.2214 15.3433 34.8005 14.7319 30.1308 14.1759C27.583 14.0064 25.0592 13.5779 22.5981 12.8973C25.1391 12.7429 27.6889 12.8266 30.2142 13.1474L48.5317 14.4261C55.703 14.9542 62.1794 15.5101 66.8491 16.0382C69.401 16.1644 71.9339 16.5462 74.4096 17.1778V17.1778Z" fill="#455A64"/>
                    <path id="Vector_6" d="M81.2194 30.8256C79.8676 22.9805 79.4756 14.9999 80.052 7.06009C81.4037 14.9052 81.7958 22.8857 81.2194 30.8256V30.8256Z" fill="#455A64"/>
                    <path id="Vector_7" d="M87.0846 31.1313C85.9821 27.2743 85.3475 23.2988 85.1945 19.2903C84.5582 15.3301 84.4088 11.3069 84.7497 7.31033C85.834 11.1713 86.4682 15.1446 86.6398 19.1513C87.2595 23.1132 87.4088 27.1344 87.0846 31.1313V31.1313Z" fill="#455A64"/>
                    <path id="Vector_8" d="M36.4126 18.8456C46.6693 19.5405 54.4799 20.0408 62.6519 20.2354Z" fill="white"/>
                    <path id="Vector_9" d="M62.6519 20.2354C58.2834 20.7305 53.8729 20.7305 49.5044 20.2354C45.1023 20.2336 40.7131 19.7583 36.4126 18.8178C40.7812 18.3241 45.1914 18.3241 49.56 18.8178C53.9622 18.8196 58.3514 19.2949 62.6519 20.2354Z" fill="#455A64"/>
                    <path id="Vector_10" d="M18.3732 127.972L15.8438 101.51L109.293 101.677L114.38 127.638L18.3732 127.972Z" fill="#4E91F9"/>
                    <path id="Vector_11" opacity="0.5" d="M18.3732 127.972L15.8438 101.51L109.293 101.677L114.38 127.638L18.3732 127.972Z" fill="white"/>
                    <path id="Vector_12" d="M37.168 111.85L37.1597 116.631L95.6142 116.733L95.6226 111.952L37.168 111.85Z" fill="#263238"/>
                    <path id="Vector_13" d="M5.19775 103.734L2.94629 77.2724L96.3959 78.412L100.76 101.9L5.19775 103.734Z" fill="#263238"/>
                    <path id="Vector_14" d="M3.25244 80.8581L4.72562 98.7308L95.618 97.8136L92.7272 81.4696L3.25244 80.8581Z" fill="white"/>
                    <path id="Vector_15" d="M87.9461 88.7799C86.8649 88.98 85.7644 89.0546 84.6662 89.0023H75.7159C68.1554 89.0023 57.732 89.0022 46.2245 88.7243C34.717 88.4463 24.2936 88.2518 16.7331 88.0017L7.81065 87.6125C6.70768 87.6394 5.60574 87.5273 4.53076 87.2789C5.61142 87.0753 6.7124 87.0007 7.81065 87.0566H16.7609C24.2936 87.0566 34.717 87.0565 46.2523 87.3345C57.7876 87.6125 68.1832 87.8071 75.7437 88.0572L84.6662 88.4464C85.7691 88.4195 86.8711 88.5316 87.9461 88.7799Z" fill="#263238"/>
                    <path id="Vector_16" d="M87.9462 91.0314C86.8616 91.278 85.7506 91.39 84.6385 91.3649L75.6327 91.7263C68.0444 91.9764 57.5376 92.1987 45.9467 92.3655C34.3559 92.5323 23.71 92.5879 16.233 92.5601H7.22714C6.11846 92.6152 5.00722 92.5312 3.91943 92.3099C5.00957 92.0984 6.11673 91.9868 7.22714 91.9764L16.233 91.6151C23.8212 91.3927 34.3281 91.1703 45.9189 91.0035C57.5098 90.8368 68.0166 90.7534 75.6327 90.7812H84.6385C85.7467 90.7545 86.8547 90.8383 87.9462 91.0314V91.0314Z" fill="#263238"/>
                    <path id="Vector_17" d="M6.58753 78.4676L4.83643 51.9504L98.2582 54.8968L102.15 78.4399L6.58753 78.4676Z" fill="#455A64"/>
                    <path id="Vector_18" d="M10.2844 75.1322L101.205 73.8258L98.6752 57.315L8.58887 55.6473L10.2844 75.1322Z" fill="white"/>
                    <path id="Vector_19" d="M9.14491 52.4508L8.2832 25.9058L101.538 31.993L104.651 55.6473L9.14491 52.4508Z" fill="#4E91F9"/>
                    <path id="Vector_20" d="M28.2453 32.9965L27.9585 37.7773L86.4131 41.2846L86.7 36.5037L28.2453 32.9965Z" fill="#263238"/>
                    <path id="Vector_21" d="M99.5927 64.125C98.4185 64.332 97.227 64.4251 96.0349 64.4029L86.3063 64.6809C77.9676 64.8477 66.8492 64.9588 54.2299 65.0144C41.6106 65.07 30.3533 65.0144 22.1258 65.0144L12.425 64.8199C11.2232 64.8608 10.0205 64.7676 8.83936 64.5419C10.0136 64.3349 11.2051 64.2418 12.3972 64.264L22.1258 63.986C30.4645 63.8192 41.5828 63.708 54.2299 63.6525C66.877 63.5969 78.1066 63.6525 86.3063 63.6525L96.0349 63.847C97.2275 63.8047 98.4211 63.898 99.5927 64.125Z" fill="#263238"/>
                    <path id="Vector_22" d="M100.676 69.2672C99.4829 69.4663 98.2719 69.5409 97.063 69.4896H87.2788C78.9401 69.4896 67.5716 69.4896 54.9523 69.2394C42.333 68.9893 30.9367 68.8503 22.6535 68.6001L12.8694 68.2387C11.6668 68.2301 10.4672 68.1185 9.28369 67.9052C10.4651 67.6824 11.6685 67.5984 12.8694 67.6551H22.6535C30.9923 67.6551 42.3607 67.655 54.9801 67.8774C67.5994 68.0998 79.0235 68.2944 87.3066 68.5445L97.0908 68.9058C98.2959 68.8878 99.4991 69.009 100.676 69.2672Z" fill="#263238"/>
                    </g>
                </svg>

            </div>
            <div class="align-self-center p-2">
                <p style="font-size: 24px; font-weight:600" class="">Ebook</p>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                @foreach ($materi as $item)
                <li class='sidebar-title'>{{ ucwords($item->nama_materi) }}</li>
                @php
                    $materiKonten = \App\Models\MateriKonten::where('materi_id', $item->id)
                                                            ->orderBy('urutan')
                                                            ->get();      
                    /* dd($materiKonten);  */                                         
                @endphp
                @foreach ($materiKonten as $kontenItem)
                @php
                    $noMateri+=1;
                    /* dd($kontenItem); */
                    $materiSelesai = \App\Models\MateriKontenSelesai::select('id', 'materi_konten_id')
                                                                    ->where('materi_konten_id', $kontenItem->id)
                                                                    ->orderBy('updated_at', 'DESC')
                                                                    ->get();

                    // $getMateriSelesai = \App\Models\MateriKontenSelesai::select('id', 'materi_konten_id')
                    //                                                     ->where('materi_konten_id', $kontenItem->id)
                    //                                                     ->get();
                    $materiAda = null;
                    /* dd($kontenItem->id); */
                    /* dd($materiSelesai); */
                    if($materiSelesai == null) {
                        $materiAda = 0;
                    }
                    else {
                        $materiAda = count($materiSelesai);
                    }
                    $isActive; // navbar item aktif ketika sedang berada di halaman
                    $isDone; // navbar item aktif ketika materi telah ditandai selesai

                    if(($materiAda > 0 || $materiAda != null) && $kontenItem->id == $materiSelesai[0]->materi_konten_id ) {
                        $isDone = true;
                    }
                    else {
                        $isDone = false;
                    }

                    if((Request::segment(4) == $kontenItem->slug)) {
                        $isActive = true;
                    }
                    else {
                        $isActive = false;
                    }
                @endphp
                <li class="sidebar-item {{ $isActive ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/detail-kelas-aktif-ebook/'.$kelas->slug.'/'.$kontenItem->slug.'/'.$kontenItem->urutan.'/'.$noMateri) }}" class='sidebar-link'>
                        <span>{{ ucwords($kontenItem->judul_konten_materi) }}</span>
                        @if ($isDone == 'active')
                        <span class="materi-icon material-icons">
                            check_circle
                        </span>
                        @endif
                    </a>

                </li>
                
                {{-- {{$materiSelesai != null && $kontenItem->id == $materiSelesai[0]->id ? 'active' : $kontenItem->id}} --}}
                @endforeach
                @endforeach
                {{-- @php
                    dd($getMateriSelesai);
                @endphp --}}
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
@endsection
