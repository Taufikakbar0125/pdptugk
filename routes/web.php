<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidasiDataAuthController;
use App\Http\Controllers\Admin\JenisMasalahController;
use App\Http\Controllers\Admin\PengajuanValidasiController;

Route::get('/', function () {
    $menus = \App\Models\LandingMenu::orderBy('order_num')->orderBy('id')->get();
    $slides = \App\Models\HeroSlide::active()->orderBy('order_num')->orderBy('id')->get();
    return view('index', compact('menus', 'slides'));
});

Route::get('/konversi-nilai/login', function () {
    return view('konversi-nilai.login');
});

Route::get('/konversi-nilai/sso', function () {
    return view('konversi-nilai.sso');
});

Route::get('/validasi-data/login', [ValidasiDataAuthController::class, 'showLoginForm'])->name('validasi-data.login');
Route::post('/validasi-data/login', [ValidasiDataAuthController::class, 'login'])->name('validasi-data.login.post');

Route::get('/validasi-data/lupa-password', [ValidasiDataAuthController::class, 'showForgotPassword'])->name('validasi-data.forgot-password');
Route::post('/validasi-data/lupa-password', [ValidasiDataAuthController::class, 'sendResetOtp'])->middleware('throttle:3,15')->name('validasi-data.forgot-password.post');

Route::get('/validasi-data/reset-verify-otp', [ValidasiDataAuthController::class, 'showResetOtpForm'])->name('validasi-data.reset-verify-otp');
Route::post('/validasi-data/reset-verify-otp', [ValidasiDataAuthController::class, 'verifyResetOtp'])->name('validasi-data.reset-verify-otp.post');

Route::get('/validasi-data/reset-password', [ValidasiDataAuthController::class, 'showNewPasswordForm'])->name('validasi-data.reset-password');
Route::post('/validasi-data/reset-password', [ValidasiDataAuthController::class, 'resetPassword'])->name('validasi-data.reset-password.post');


// ── Validasi Data — Registrasi & OTP ────────────────────

Route::get('/validasi-data/register', function () {
    return view('validasi-data.register');
})->name('validasi-data.register.view');

Route::post('/validasi-data/register', [ValidasiDataAuthController::class, 'register'])
    ->name('validasi-data.register.post');

Route::get('/validasi-data/verify-otp', [ValidasiDataAuthController::class, 'showVerifyOtp'])
    ->name('validasi-data.verify-otp');

Route::post('/validasi-data/verify-otp', [ValidasiDataAuthController::class, 'verifyOtp'])
    ->name('validasi-data.verify-otp.post');

Route::post('/validasi-data/resend-otp', [ValidasiDataAuthController::class, 'resendOtp'])
    ->name('validasi-data.resend-otp');

Route::get('/validasi-data/register-success', [ValidasiDataAuthController::class, 'registerSuccess'])
    ->name('validasi-data.register.success');

// Route refresh captcha — mengembalikan URL gambar captcha baru
Route::get('/validasi-data/captcha-refresh', function () {
    $src = captcha_src('flat');
    // Pastikan tidak ada double query string
    $baseUrl = strtok($src, '?');
    return response()->json([
        'url' => $baseUrl . '?t=' . time(),
    ]);
})->name('validasi-data.captcha-refresh');

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/validasi-data/dashboard', [ValidasiDataAuthController::class, 'dashboard'])
        ->name('validasi-data.dashboard');
    Route::post('/validasi-data/pengajuan', [ValidasiDataAuthController::class, 'storeRequest'])
        ->name('validasi-data.pengajuan.post');
    Route::post('/validasi-data/logout', [ValidasiDataAuthController::class, 'logout'])
        ->name('validasi-data.logout');
});

use App\Http\Controllers\FrontendController;

Route::get('/pdpt/home', [FrontendController::class, 'pdptHome']);
Route::get('/pdpt/akreditasi-institusi', [FrontendController::class, 'akreditasiInstitusi']);
Route::get('/pdpt/akreditasi-prodi', [FrontendController::class, 'akreditasiProdi']);
Route::get('/pdpt/akreditasi-asic', [FrontendController::class, 'akreditasiAsic']);
Route::get('/pdpt/akreditasi-asiin', [FrontendController::class, 'akreditasiAsiin']);
Route::get('/pdpt/data-dosen', [FrontendController::class, 'dataDosen']);
Route::get('/pdpt/data-tendik', [FrontendController::class, 'dataTendik']);
Route::get('/pdpt/rekap-dosen', [FrontendController::class, 'rekapDosen']);
Route::get('/pdpt/rekap-tendik', [FrontendController::class, 'rekapTendik']);
Route::get('/pdpt/buku-info-akademik', [FrontendController::class, 'bukuInfoAkademik']);
Route::get('/pdpt/tentang', [FrontendController::class, 'tentang']);

// ============================================
// ADMIN ROUTES
// ============================================
use App\Http\Controllers\Admin\AuthController;

use App\Http\Controllers\Admin\AkreditasiInstitusiController;
use App\Http\Controllers\Admin\AkreditasiProdiController;
use App\Http\Controllers\Admin\AkreditasiInternasionalController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\TendikController;

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Google Drive OAuth (harus di dalam prefix admin tapi di luar auth middleware agar callback bisa diakses)
    Route::get('google/callback', [\App\Http\Controllers\Admin\GoogleAuthController::class, 'callback'])->name('admin.google.callback');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('dashboard', function() {
            $stats = [
                'prodi' => \App\Models\AkreditasiProdi::count(),
                'dosen' => \App\Models\Dosen::count(),
                'tendik' => \App\Models\Tendik::count(),
                'internasional' => \App\Models\AkreditasiInternasional::count(),
                'buku' => \App\Models\BukuAkademik::count()
            ];
            $chartData = [
                'akred' => \App\Models\AkreditasiProdi::select('peringkat', \DB::raw('count(*) as total'))->groupBy('peringkat')->get(),
                'dosen' => \App\Models\Dosen::select('jabatan', \DB::raw('count(*) as total'))->groupBy('jabatan')->get(),
                'tendik' => \App\Models\Tendik::select('status_kepegawaian', \DB::raw('count(*) as total'))->groupBy('status_kepegawaian')->get(),
            ];

            $gdriveConnected = app(\App\Services\GoogleDriveService::class)->isAuthorized();

            return view('admin.dashboard', compact('stats', 'chartData', 'gdriveConnected'));
        })->name('admin.dashboard');

        Route::resource('akreditasi-institusi', AkreditasiInstitusiController::class, ['as' => 'admin']);
        Route::resource('akreditasi-prodi', AkreditasiProdiController::class, ['as' => 'admin']);
        Route::resource('akreditasi-internasional', AkreditasiInternasionalController::class, ['as' => 'admin']);
        Route::resource('dosen', DosenController::class, ['as' => 'admin']);
        Route::resource('tendik', TendikController::class, ['as' => 'admin']);
        Route::resource('buku-akademik', \App\Http\Controllers\Admin\BukuAkademikController::class, ['as' => 'admin']);
        Route::resource('landing-menu', \App\Http\Controllers\Admin\LandingMenuController::class, ['as' => 'admin']);
        Route::resource('hero-slide', \App\Http\Controllers\Admin\HeroSlideController::class, ['as' => 'admin']);
        Route::resource('jenis-masalah', JenisMasalahController::class, ['as' => 'admin'])->except(['create', 'edit', 'show']);
        Route::resource('pengajuan-validasi', PengajuanValidasiController::class, ['as' => 'admin'])->only(['index', 'show', 'update']);

        // Template & Export routes
        Route::get('template', [\App\Http\Controllers\Admin\TemplateController::class, 'index'])->name('admin.template.index');
        Route::get('template/download/{category}', [\App\Http\Controllers\Admin\TemplateController::class, 'downloadTemplate'])->name('admin.template.download');
        Route::get('template/export/{category}', [\App\Http\Controllers\Admin\TemplateController::class, 'exportData'])->name('admin.template.export');
        Route::post('template/import/{category}', [\App\Http\Controllers\Admin\TemplateController::class, 'import'])->name('admin.template.import');

        // Google Drive push & auth
        Route::post('pengajuan-validasi/{id}/push-gdrive', [PengajuanValidasiController::class, 'pushToGDrive'])->name('admin.pengajuan-validasi.push-gdrive');
        Route::get('google/auth', [\App\Http\Controllers\Admin\GoogleAuthController::class, 'redirect'])->name('admin.google.auth');
        Route::post('google/disconnect', [\App\Http\Controllers\Admin\GoogleAuthController::class, 'disconnect'])->name('admin.google.disconnect');
    });
});


