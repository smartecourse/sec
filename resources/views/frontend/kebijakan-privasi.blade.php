@extends('frontend.layouts.template')
@section('content')
    <section class="bg-100 py-700" id="kelas">
        <div class="container-lg text-center mt-4">
            <h4 class="title-text-big mb-0 pb-0"> Kebijakan Privasi</h4>
            <hr class="mx-auto" width="30%">
            <div class="card shadow-sm p-3 mb-5 mt-5 bg-body rounded" style="border: none">
                {!! $kebijakan->konten !!}
            </div>
        </div>
    </section>
@endsection
