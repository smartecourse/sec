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
          <h1 class="">Masuk</h1>
          <p>Silahkan masuk terlebih dahulu untuk melanjutkan</p>
          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terdapat Kesalahan!</strong> {{ session('error') }} .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <form action=" {{ route('login-process-frontend') }} " method="post">
            @csrf
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" class="form-control" type="email" name="email" autofocus placeholder="Exp:user@gmail.com">
            </div>
            <div class="form-group mt-4">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" data-toggle="password" autocomplete="current-password" placeholder="Masukkan password">
            </div>
            <div class="form-group mt-4 d-flex justify-content-between">
                <div class="d-flex">
                    <input type="checkbox" name="remember" id="remember_me">
                    <p class="">{{ __(' Remember me')}} </p>
                </div>
                <a href="{{ route('password.request') }}" class="d-flex justify-content-end lupa-password">Lupa Password</a>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100 btn-masuk text-uppercase">Masuk</button>
            </div>
          </form>
            <div class="mt-3">
                <a type="submit" class="btn btn-default w-100 btn-google text-uppercase" href="{{ route('login-google') }}">
                    <svg width="25" height="25" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                    <path d="M47.532 24.5529C47.532 22.9214 47.3997 21.2811 47.1175 19.6761H24.48V28.9181H37.4434C36.9055 31.8988 35.177 34.5356 32.6461 36.2111V42.2078H40.3801C44.9217 38.0278 47.532 31.8547 47.532 24.5529Z" fill="#4285F4"/>
                    <path d="M24.4802 48.0016C30.9531 48.0016 36.4119 45.8764 40.3891 42.2078L32.6551 36.2111C30.5034 37.675 27.7255 38.5039 24.489 38.5039C18.2278 38.5039 12.9189 34.2798 11.0141 28.6006H3.0332V34.7825C7.10743 42.8868 15.4058 48.0016 24.4802 48.0016V48.0016Z" fill="#34A853"/>
                    <path d="M11.0051 28.6005C9.99973 25.6198 9.99973 22.3922 11.0051 19.4115V13.2296H3.03298C-0.371021 20.0112 -0.371021 28.0009 3.03298 34.7824L11.0051 28.6005V28.6005Z" fill="#FBBC04"/>
                    <path d="M24.4802 9.49932C27.9018 9.44641 31.2088 10.7339 33.6869 13.0973L40.539 6.24523C36.2002 2.17101 30.4416 -0.068932 24.4802 0.00161733C15.4058 0.00161733 7.10743 5.11644 3.0332 13.2296L11.0053 19.4115C12.9013 13.7235 18.2189 9.49932 24.4802 9.49932V9.49932Z" fill="#EA4335"/>
                    </g>
                    <defs>
                    <clipPath id="clip0">
                    <rect width="48" height="48" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg> Masuk dengan Google
                </a>
            </div>
          <div class="d-flex justify-content-center mt-4">
            <p>Tidak punya akun ? </p><a href="{{ route('register-process') }} " class="daftar-akun"> Mendaftar</a>
          </div>
        </div>
      </div>
    </div>
</div>
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
