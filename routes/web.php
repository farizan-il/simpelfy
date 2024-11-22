<?php

use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\Gondowangi\Authentication\AuthentifikasiController;
use App\Http\Controllers\Gondowangi\Backend\AktivitasKaryawanController;
use App\Http\Controllers\Gondowangi\Backend\BlogBeritaController;
use App\Http\Controllers\Gondowangi\Backend\DashboardController;
use App\Http\Controllers\Gondowangi\Backend\DashboardKaryawanController;
use App\Http\Controllers\Gondowangi\Backend\KelasController;
use App\Http\Controllers\Gondowangi\Frontend\BerandaController;
use App\Http\Controllers\Gondowangi\Backend\ModulKelasController;
use App\Http\Controllers\Gondowangi\Frontend\DetailKelasController;
use App\Http\Controllers\Gondowangi\Frontend\ExploreController;
use App\Http\Controllers\Gondowangi\Frontend\KelasSayaController;
use App\Http\Controllers\Gondowangi\Frontend\KeranjangController;
use App\Http\Controllers\Gondowangi\Backend\KelolaKaryawanController;
use App\Http\Controllers\Gondowangi\Frontend\PaymentKelasController;
use App\Http\Controllers\Gondowangi\Backend\KaryawanResign;
use App\Http\Controllers\Gondowangi\Frontend\ProfileSayaController;
use App\Http\Controllers\Gondowangi\Backend\KategoriKelas;
use App\Http\Controllers\Gondowangi\Backend\KategoriKelasController;
use App\Http\Controllers\Gondowangi\Backend\KelolaKomentarKelasController;
use App\Http\Controllers\Gondowangi\Backend\ManjemenStrukturController;
use App\Http\Controllers\Gondowangi\Backend\KelolaKoinController;
use App\Http\Controllers\Gondowangi\Backend\KelolaWebinarController;
use App\Http\Controllers\Gondowangi\Frontend\ujianController;
use App\Http\Controllers\Gondowangi\Frontend\DiscoveryController;
use App\Http\Controllers\Gondowangi\Backend\FaqController;
use App\Http\Controllers\Gondowangi\Backend\FaqKategoriController;
use App\Http\Controllers\Gondowangi\Frontend\ArtikelController;
use App\Http\Controllers\Gondowangi\Frontend\KelasWajibController;
use App\Http\Controllers\Gondowangi\Frontend\PengaduanController;
use App\Http\Controllers\Gondowangi\Backend\KelolaInformasiController;
use App\Http\Controllers\Gondowangi\Backend\PengaduanAdminController;
use App\Http\Controllers\PemantauanDataTraining;
use App\Http\Controllers\testcontroller;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/', ExploreController::class);
Route::resource('/explore', ExploreController::class);
Route::resource('/discovery', DiscoveryController::class);
Route::resource('/coming', ComingSoonController::class);
Route::get('/detailkelas/{id}', [DetailKelasController::class, 'index'])->name('detailkelas');
// Route::resource('/ujian', ujianController::class);
Route::get('/ujian/{kelasId}', [ujianController::class, 'index'])->name('ujian.index');

Route::get('/masuk', [AuthentifikasiController::class, 'showLoginForm'])->name('login');
Route::post('/masuk', [AuthentifikasiController::class, 'login']);
Route::post('/keluar', [AuthentifikasiController::class, 'logout']);

Route::middleware(['authAccess:enduser'])->group(function () {
    Route::get('/onboarding', [AuthentifikasiController::class, 'showOnboardingForm'])->name('onboarding');
    Route::post('/onboarding', [AuthentifikasiController::class, 'submitOnboardingForm'])->name('onboarding.submit');

    Route::get('/dashboard-data/{employeeId}', [DashboardController::class, 'getDashboardData']);

    Route::resource('/kelassaya', KelasSayaController::class);
    Route::post('/kelassaya/{kelas_id}/komentar-reply', [KelasSayaController::class, 'storeKomentarOrReply'])->name('kelassaya.storeKomentarOrReply');
    Route::post('/kelassaya/{id}/submit-review', [KelasSayaController::class, 'submitReview']);
    Route::post('/update-status/{modulDetailId}', [KelasSayaController::class, 'updateStatus'])->name('updateStatus');
    // Route::post('/update-spent-time/{modulDetailId}', [KelasSayaController::class, 'updateSpentTime']);
    Route::post('/save-time-spent', [KelasSayaController::class, 'saveTimeSpent']);

    Route::resource('/keranjang', KeranjangController::class);
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');

    Route::resource('/paymentkelas', PaymentKelasController::class);
    Route::post('/paymentkelas/beli', [PaymentKelasController::class, 'tambah'])->name('payment.beli');
    Route::post('/paymentkelas', [PaymentKelasController::class, 'store'])->name('paymentkelas.store');
    Route::post('/apply', [PaymentKelasController::class, 'applyVoucher'])->name('apply.voucher');
    
    Route::resource('/dashboarduser', BerandaController::class);
    Route::get('/get-transaction-data', [BerandaController::class, 'index'])->name('get.transaction.data');

    Route::resource('/profilesaya', ProfileSayaController::class);
    Route::resource('/kelaswajib', KelasWajibController::class);

    Route::get('/profile/filter-activity', [ProfileSayaController::class, 'filterActivity'])->name('profile.filterActivity');
    
    Route::post('/submit-answers', [ujianController::class, 'submitAnswers'])->name('submit.answers');
    Route::resource('/artikel', ArtikelController::class);

    Route::resource('/pengaduan', PengaduanController::class);
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{id}/messages', [PengaduanController::class, 'getMessages']);
    Route::post('/pengaduan/{id}/send-message', [PengaduanController::class, 'sendMessage']);
});

Route::middleware(['authAccess:superadmin'])->group(function () {
    // Route khusus untuk superadmin
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/dashboardkaryawan', DashboardKaryawanController::class);
    Route::resource('/kelolakelas', KelasController::class);
    Route::post('/kelolakelas/update-status/{id}', [KelasController::class, 'updateStatus'])->name('kelolakelas.updateStatus');

    Route::resource('/kelolakoin', KelolaKoinController::class);
    Route::post('/kirim-koin', [KelolaKoinController::class, 'kirimKoin'])->name('kirim-koin');
    
    Route::resource('/kategorikelas', KategoriKelasController::class);
    Route::post('/subkategori', [KategoriKelasController::class, 'storeSubkategori'])->name('subkategori.store');
    Route::resource('/kelolastruktur', ManjemenStrukturController::class);

    Route::resource('/komentarkelas', KelolaKomentarKelasController::class);
    Route::post('/komentarkelas/update-status/{id}', [KelolaKomentarKelasController::class, 'updateStatus'])->name('komentarkelas.updateStatus');

    Route::resource('/kelolamodul', ModulKelasController::class);
    Route::post('/combined-form/store', [ModulKelasController::class, 'addPreTest'])->name('combinedForm.store');
    
    Route::resource('/kelolawebinar', KelolaWebinarController::class);
    Route::resource('/kelolainformasi', KelolaInformasiController::class);

    Route::resource('/kelolakaryawan', KelolaKaryawanController::class);
    Route::patch('/kelolakaryawan/updateStatus/{id}', [KelolaKaryawanController::class, 'updateStatus'])->name('kelolakaryawan.updateStatus');
    Route::patch('/kelolakaryawan/updateKoin/{id}', [KelolaKaryawanController::class, 'updateKoin'])->name('kelolakaryawan.updateKoin');

    Route::resource('/karyawanresign', KaryawanResign::class);
    
    Route::resource('/pemantauanTraining', PemantauanDataTraining::class);
    Route::resource('/aktivitaskaryawan', AktivitasKaryawanController::class);
    Route::post('/aktivitaskaryawan/send-notification', [AktivitasKaryawanController::class, 'sendNotification'])->name('aktivitaskaryawan.sendNotification');

    Route::resource('/pengaduankaryawan', PengaduanAdminController::class);
    Route::get('/pengaduankaryawan/{id}/detail', [PengaduanAdminController::class, 'showDetail'])->name('pengaduan.detail');


    
    Route::resource('/blog', BlogBeritaController::class);
    Route::resource('/kelolafaq', FaqController::class);
    Route::resource('/kategorifaq', FaqKategoriController::class);
});

Route::resource('/test', testcontroller::class);