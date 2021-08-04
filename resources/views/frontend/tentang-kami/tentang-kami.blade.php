@extends('frontend.layouts.template')
@section('content')
<section class="bg-100 py-700" id="kelas">
    <div class="container-lg text-center m-4">
        <h1 class="title-text-big mb-0 pb-0" style="">SEC</h1>
        <hr class="mx-auto" width="5%">
        <p class="text-caption text-center"> <strong>SEC(Smart English Course)</strong> Merupakan Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut accusantium pariatur ratione, laboriosam deleniti, explicabo eos soluta amet molestias, voluptatum quidem facilis provident minima! Deleniti qui repellendus sapiente aliquid quam?</p>
        <strong>Kritik dan Saran : <a href="" class="email-card">sec@gmail.com</a></strong>
        <hr style="border: 1px solid #DEE5F5" class="mt-4">
    </div>
    <div class="katalog-kelas mb-5">
        <div class="container-lg">
            <div class="text-center">
                <h1 class="title-text-big mb-0 pb-0" style="">Tim Kami</h1>
                <hr class="mx-auto" style="width: 15%">
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card d-flex p-4 text-center">
                        <div><img class="img-fluid tim" src=" {{ asset('frontend/assets/img/person-1.jpg') }} " alt=""> </div>
                        <div class="p-4">
                            <h2 class="card-title">Steven Ongsky</h2>
                            <p>Android Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card d-flex p-4 text-center">
                        <div> <img class="img-fluid tim" src=" {{ asset('frontend/assets/img/person-2.jpg') }} " alt=""> </div>
                        <div class="p-4">
                            <h2 class="card-title">Laorene Heidar</h2>
                            <p>Web Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card d-flex p-4 text-center ">
                        <div><img class="img-fluid tim" src=" {{ asset('frontend/assets/img/person-3.jpg') }} " alt=""> </div>
                        <div class="p-4">
                            <h2 class="card-title">Tegar Al-Ayubi</h2>
                            <p>UI/UX Design</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
