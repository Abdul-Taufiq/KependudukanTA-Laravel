<?php

use App\Http\Controllers\KadesController;
use App\Http\Controllers\SekdesController;
use App\Http\Controllers\KkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\KematianController;
use App\Http\Controllers\PindahController;
use App\Http\Controllers\DatangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', function () {
    return view ('login.login');
});

Route::get('/tentang', function(){
	return view('About.tentang',[
        "tittle" => "Tentang Kelurahan Desa Ngilen"
    ]);
});

Route::get('/alamat', function(){
	return view('About.alamat',[
        "tittle" => "Alamat Kelurahan Desa Ngilen"
    ]);
});

Route::get('/struktur', function(){
	return view('About.struktur',[
        "tittle" => "Struktur Organisasi Kelurahan Desa Ngilen"
    ]);
});

Route::get('/visimisi', function(){
	return view('About.visimisi',[
        "tittle" => "Visi & Misi Organisasi Kelurahan Desa Ngilen"
    ]);
});

// Login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'postlogin']);
Route::get('/refereshcapcha', [HelperController::class, 'refereshCaptcha']);

// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Auth::routes(['verify' => true]);

// Lupa Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


// HAK AKSES KADES
Route::group(['middleware' => ['auth','ceklevel:KADES']], function(){

	// User
	Route::resource('user', UserController::class);
	Route::get('user/cetak/cetakdatauser', [UserController::class, 'cetakdatauser'])->name('cetak-user');
	Route::get('user/cetak/cetakdatauser-pertanggal/{tglawal}/{tglakhir}', [UserController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
});


// HAK AKSES SEKDES
Route::group(['middleware' => ['auth','ceklevel:KADES,SEKDES']], function(){
	
	// KK
	Route::resource('kk', KkController::class);
	Route::get('kk/cetak/cetakdatakk', [KkController::class, 'cetakdatakk'])->name('cetak-kk');
	Route::get('kk/cetak/cetakdatakk-pertanggal/{tglawal}/{tglakhir}', [KkController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('kk/cetak/cetak-detail-datakk/{kk}', [KkController::class, 'cetakdetaildatakk'])->name('cetak-kk');

	// Penduduk
	Route::resource('penduduk', PendudukController::class);
	Route::get('penduduk/cetak/cetakdatapenduduk', [PendudukController::class, 'cetakdatapenduduk'])->name('cetak-penduduk');
	Route::get('penduduk/cetak/cetakdatapenduduk-pertanggal/{tglawal}/{tglakhir}', [PendudukController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('penduduk/cetak/cetak-detail-datapenduduk/{penduduk}', [PendudukController::class, 'cetakdetaildatapenduduk'])->name('cetak-penduduk');

	Route::get('penduduk/json', [PendudukController::class, 'json']);
	Route::get('data/index', [PendudukController::class, 'indexnyoba'])->name('data');

	// Kelahiran
	Route::resource('kelahiran', KelahiranController::class);
	Route::get('kelahiran/cetak/cetak-data-kelahiran', [KelahiranController::class, 'cetakdatakelahiran'])->name('cetak-kelahiran');
	Route::get('kelahiran/cetak/cetakdatakelahiran-pertanggal/{tglawal}/{tglakhir}', [KelahiranController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('kelahiran/cetak/cetak-detail-kelahiran/{kelahiran}', [KelahiranController::class, 'cetakdetaildatakelahiran'])->name('cetak-detail-kelahiran');

	// kematian
	Route::resource('kematian', KematianController::class);
	Route::get('kematian/cetak/cetak-data-kematian', [KematianController::class, 'cetakdatakematian'])->name('cetak-kematian');
	Route::get('kematian/cetak/cetakdatakematian-pertanggal/{tglawal}/{tglakhir}', [KematianController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('kematian/cetak/cetak-detail-kematian/{kematian}', [KematianController::class, 'cetakdetaildatakematian'])->name('cetak-detail-kematian');

	// pindah
	Route::resource('pindah', PindahController::class);
	Route::get('pindah/cetak/cetak-data-pindah', [PindahController::class, 'cetakdatapindah'])->name('cetak-pindah');
	Route::get('pindah/cetak/cetakdatapindah-pertanggal/{tglawal}/{tglakhir}', [PindahController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('pindah/cetak/cetak-detail-pindah/{pindah}', [PindahController::class, 'cetakdetaildatapindah'])->name('cetak-detail-pindah');

	// Datang
	Route::resource('datang', DatangController::class);
	Route::get('datang/cetak/cetak-data-datang', [DatangController::class, 'cetakdatadatang'])->name('cetak-datang');
	Route::get('datang/cetak/cetakdatadatang-pertanggal/{tglawal}/{tglakhir}', [DatangController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('datang/cetak/cetak-detail-datang/{datang}', [DatangController::class, 'cetakdetaildatadatang'])->name('cetak-detail-datang');


	// Kades
	Route::resource('kades', KadesController::class);
	Route::get('kades/cetak/cetak-data-kades', [KadesController::class, 'cetakdatakades'])->name('cetak-kades');
	Route::get('kades/cetak/cetakdatakades-pertanggal/{tglawal}/{tglakhir}', [KadesController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('kades/cetak/cetak-detail-kades/{kades}', [KadesController::class, 'cetakdetaildatakades'])->name('cetak-detail-kades');
	Route::get('kades/edit-data/{id_kades}', [KadesController::class, 'editkades']);
	Route::patch('/kades/edit-proses/{id_kades}', [KadesController::class, 'editProses']);
	Route::delete('/kades/hapus/{id_kades}', [KadesController::class, 'delete']);


	// Sekdes
	Route::resource('sekdes', SekdesController::class);
	Route::get('sekdes/cetak/cetak-data-sekdes', [SekdesController::class, 'cetakdatasekdes'])->name('cetak-sekdes');
	Route::get('sekdes/cetak/cetakdatasekdes-pertanggal/{tglawal}/{tglakhir}', [SekdesController::class, 'cetakpertanggal'])->name('cetak-data-pertanggal');
	Route::get('sekdes/cetak/cetak-detail-sekdes/{sekdes}', [SekdesController::class, 'cetakdetaildatasekdes'])->name('cetak-detail-sekdes');

});


// HAK AKSES USER
Route::group(['middleware' => ['auth','ceklevel:KADES,SEKDES,USER']], function(){

	// Home
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
});





// Manual
// Route::post('/kk/add', [KkController::class, 'tambahkk']);
// Route::get('/CRUD kependudukan/updatekk/{id_kk}', [KkController::class, 'editkk']);
// Route::patch('/kk/{id_kk}', [KkController::class, 'editProses']);
// Route::delete('/kk/{id_kk}', [KkController::class, 'delete']);




