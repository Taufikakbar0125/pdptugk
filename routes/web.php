<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $menus = \App\Models\LandingMenu::orderBy('order_num')->orderBy('id')->get();
    return view('index', compact('menus'));
});

Route::get('/konversi-nilai/login', function () {
    return view('konversi-nilai.login');
});

Route::get('/konversi-nilai/sso', function () {
    return view('konversi-nilai.sso');
});

Route::get('/validasi-data/login', function () {
    return view('validasi-data.login');
});

Route::get('/validasi-data/lupa-password', function () {
    return view('validasi-data.lupa-password');
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

    Route::middleware(['auth'])->group(function () {
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
            return view('admin.dashboard', compact('stats', 'chartData'));
        })->name('admin.dashboard');

        Route::resource('akreditasi-institusi', AkreditasiInstitusiController::class, ['as' => 'admin']);
        Route::resource('akreditasi-prodi', AkreditasiProdiController::class, ['as' => 'admin']);
        Route::resource('akreditasi-internasional', AkreditasiInternasionalController::class, ['as' => 'admin']);
        Route::resource('dosen', DosenController::class, ['as' => 'admin']);
        Route::resource('tendik', TendikController::class, ['as' => 'admin']);
        Route::resource('buku-akademik', \App\Http\Controllers\Admin\BukuAkademikController::class, ['as' => 'admin']);
        Route::resource('landing-menu', \App\Http\Controllers\Admin\LandingMenuController::class, ['as' => 'admin']);
    });
});


