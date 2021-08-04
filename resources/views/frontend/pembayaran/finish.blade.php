<!doctype html>
<html lang="en">
  <head>
    @include('frontend.layouts.partials.head')
  </head>
  <body style="background-color: #f6f8fd">
    <main class="finish-payment">
        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 d-flex justify-content-center">
              <div class="col-lg-6 col-md-12 p-3 p-lg-5 pt-lg-5 rounded shadow-lg card-finish">
                  <div class="d-flex justify-content-center mt-5">
                    <img src="{{ asset('frontend/assets/icon/sukses-icon.svg') }}" class="img-fluid w-50" alt="" srcset="">
                  </div>

                <h1 class="display-6 fw-bold lh-1 text-center p-4 mt-5 text-finish" style="">Pembayaran Sukses</h1>
                <p class="lead text-center text-heading">Selamat Memulai Pembelajaran.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-sm-center mb-4 mb-lg-3">
                  <button type="button" class="btn btn-primary btn-lg px-4 py-3 me-md-2 fw-bold mt-5">Kembali Ke Dashboard</button>
                </div>
              </div>
            </div>
        </div>
    </main>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

