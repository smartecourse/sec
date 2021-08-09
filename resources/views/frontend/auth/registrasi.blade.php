<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk - SEC</title>

    <!-- Bootstrap core CSS -->
    <link href=" {{ asset('frontend/assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href=" {{ asset('frontend/assets/css/style.css') }} " rel="stylesheet">
    {{-- animations --}}
    <link rel="stylesheet" href=" {{ asset('frontend/assets/dist/css/animations.css') }} ">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href=" {{ asset('frontend/assets/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
</head>
<body style="">
@include('frontend.layouts.partials.bottom-navbar')
<div class="sidenav-background"></div>
<div class="form-login">
    <div class="container fadeIn">
      <div class="row d-flex justify-content-center h-100 ">
        <div class="col-lg-5 col-md-12 col-sm-12 shadow mb-5 bg-body rounded card p-5" style="border: none">
          <h1 class="">Mendaftar</h1>
          <p>Silahkan mendaftar gratis untuk melanjutkan kursus.</p>
          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terdapat Kesalahan!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if (session('success'))
            <div class="alert alert-success alert-info fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }} .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <form action=" {{ route('register-process-frontend') }} " method="post">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input id="nama" class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" value="{{old('nama')}}" autofocus placeholder="Nama lengkap">
                @error('nama')
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
            <div class="form-group mt-3">
              <label for="email">Email</label>
              <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email')}}" placeholder="Exp:user@gmail.com">
              @error('email')
              <p class="text-danger">
                  {{$message}}
              </p>
              @enderror
            </div>
            <div class="form-group mt-3">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" data-toggle="password" autocomplete="current-password" placeholder="Password">
              @error('password')
              <p class="text-danger">
                  {{$message}}
              </p>
              @enderror
            </div>
            <div class="form-group mt-3">
                <label for="konfirmasiPassword">Konfirmasi Password</label>
                <input type="password" name="konfirmasiPassword" id="konfirmasiPassword" class="form-control @error('konfirmasiPassword') is-invalid @enderror" data-toggle="password" autocomplete="current-password" value="{{old('konfirmasiPassword')}}" placeholder="Konfirmasi Password">
                @error('konfirmasiPassword')
              <p class="text-danger">
                  {{$message}}
              </p>
              @enderror
            </div>
            <div class="d-flex justify-content-start mt-3 privasi">
                <div class="d-flex">
                    <input type="checkbox" name="check" id="check" class="@error('check') is-invalid @enderror">
                    <p>Saya setuju dengan </p>
                  </div>
                  <a target="_blank" href=" {{ route('kebijakan-privasi') }}" class="" > Kebijakan Privasi</a>
                </div>
            @error('check')
            <p class="text-danger">
                {{$message}}
            </p>
            @enderror
            <div class="mt-3">
                <button type="submit" class="btn btn-primary w-100 btn-masuk text-uppercase">Mendaftar</button>
            </div>
          </form>
          <div class="d-flex justify-content-center mt-4 daftar-akun">
              <div class="">
                  <p>Sudah mempunyai akun ?</p>
              </div>
                <a href=" {{ route('login-front') }} " class=""> Masuk</a>
          </div>
        </div>
      </div>
    </div>
</div>
      {{-- </div> --}}
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
