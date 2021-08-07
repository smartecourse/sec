<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\CheckAuthUser;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

/* Backend */
Route::group(['middleware' => ['auth']], function() {
    Route::prefix('master')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
        /* Profil */
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin-profile');
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('admin-update-profile');
        /* END Profil */
        /* Akun */
        Route::get('/akun', [AkunController::class, 'index']);
        Route::get('/akun/add', [AkunController::class, 'add']);
        Route::post('/akun/save', [AkunController::class, 'save']);
        Route::post('/akun/{user}/detail', [AkunController::class, 'detail']);
        Route::patch('/akun/{user}/reset', [AkunController::class, 'resetPassword']);
        Route::delete('/akun/{user}/drop', [AkunController::class, 'deactiveAccount']);
        /* END Akun */

        /* Kelas */
        Route::resource('kelas', 'KelasController');
        /* END Kelas */

        /* Jenis Kelas */
        Route::resource('jenis-kelas', 'JenisKelasController');
        /* END Jenis Kelas */

        /* Fasilitas Kelas */
        Route::resource('fasilitas-paket', 'FasilitasKelasController');
        /* END Fasilitas Kelas */

        /* Materi */
        Route::resource('materi', 'MateriController');
        /* END Materi */

        /* Konten Materi */
        Route::resource('konten-materi', 'KontenMateriController');
        /* END Konten Materi */

        Route::resource('post-test-materi', 'PostTestMateriController');

        /* Paket */
        Route::resource('paket', 'PaketController');
        /* END Paket */

        /* Transaksi */
        Route::get('transaksi', 'TransaksiController@index')->name('transaksi.index');
        // Route::post('checkout/{id}', 'TransaksiController@checkout')->name('checkout');
        /* END Transaksi */

        /* Kebijakan Privasi */
        Route::get('kebijakan-privasi', 'KebijakanController@index')->name('master-kebijakan-privasi');
        Route::post('kebijakan-privasi', 'KebijakanController@save')->name('save-master-kebijakan-privasi');
        /* END Kebijakan Privasi */

    });
});
/* END Backend */

/* Dashboard User */
Route::get('login', 'Frontend\AuthController@login')->name('login-front');
Route::post('front-login-process', 'Frontend\AuthController@loginProcess')->name('login-process-frontend');

// login google
Route::get('login/google', 'Frontend\GoogleController@redirectToGoogle')->name('login-google');
Route::get('login/google/callback','Frontend\GoogleController@handleGoogleCallback')->name('login-google-callback');

// Reset password
// Route::get('/forget-password', 'ForgotPasswordController@getEmail');
// registerUser
Route::get('register', 'Frontend\AuthController@register')->name('register-process');
Route::post('front-register-process', 'Frontend\AuthController@registerProcess')->name('register-process-frontend');
Route::get('/email/verify', function () {
    if(!Session::has('token')) {
        return redirect('login');
    }
    return view('auth.verify-email');
})->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
/* Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend'); */

Route::prefix('pembayaran')->group(function () {
    Route::post('notif', 'PembayaranController@notif')->name('pembayaran-notif');
    Route::get('finish', 'PembayaranController@finish')->name('pembayaran-finish');
    Route::get('unfinish', 'PembayaranController@unfinish')->name('pembayaran-unfinish');
    Route::get('error', 'PembayaranController@error')->name('pembayaran-error');
});
// Dashboard User
Route::prefix('dashboard')->group(function() {
    Route::get('/', 'Frontend\DashboardUserController@index');
    Route::resource('profil', 'Frontend\EditProfilController');
    Route::get('kelas-saya','Frontend\KelasSayaController@index')->name('kelas-saya');
    Route::get('detail-kelas-aktif-ebook/{slug}','Frontend\KelasSayaController@detailAktif')->name('kelas-aktif-ebook');
    Route::get('detail-kelas-aktif-video/{slug}','Frontend\KelasSayaController@detailAktifVideo')->name('kelas-aktif-video');
    Route::get('detail-kelas-aktif-ebook/{slug}/{slug_materi}/{urutan}/{nomor}','Frontend\KelasSayaController@goMateriEbook');
    Route::get('detail-kelas-aktif-video/{slug}/{slug_materi}/{urutan}/{nomor}','Frontend\KelasSayaController@goMateriVideo');
    Route::post('detail-kelas-aktif-video/{slug}/{slug_materi}/{urutan}/check','Frontend\KelasSayaController@goMateriVideoDone');
    Route::post('detail-kelas-aktif-ebook/{slug}/{slug_materi}/{urutan}/check','Frontend\KelasSayaController@goMateriEbookDone');
    Route::get('group-whatsapp','Frontend\GroupWhatsappController@index')->name('group-whatsapp');
    Route::get('list-transaksi','Frontend\DashboardUserController@listTransaksi')->name('list-transaksi');
    Route::post('review-kelas', 'Frontend\KelasSayaController@reviewKelas')->name('review-kelas');
});

Route::post('user-logout', 'Frontend\LandingPageController@logout')->name('logout-front');
// Route::get('user-logout', function() {
//     return 'asd';
// })->name('logout-front');

Route::resource('homepage', 'Frontend\HomeController')->names([
    'index' => 'homepage.index',
    'create' => 'homepage.'
]);


/* END Dashboard User */

// Landing Page
Route::get('/', 'Frontend\LandingPageController@index')->name('landing-page');
Route::get('/tentang-kami', 'Frontend\LandingPageController@tentangKami')->name('tentang-kami');
// route::prefix('katalog-kelas')->group(function(){
Route::get('/katalog-kelas', 'Frontend\LandingPageController@katalogKelas')->name('katalog-kelas');
Route::get('/detail-kelas/{slug}', 'Frontend\LandingPageController@detailKelas')->name('detail-kelas');
Route::get('/checkout/{slug}', 'Frontend\LandingPageController@checkout');
Route::post('checkout/{id}', 'Frontend\LandingPageController@checkoutProcess')->name('checkout');
Route::get('kebijakan-privasi', 'Frontend\LandingPageController@kebijakanPrivasi')->name('kebijakan-privasi');

// });
// end landing page

// Route::get('tentang-kami', 'Fronten')
/* ----------------------------------------------------------------------------------------- */
/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
