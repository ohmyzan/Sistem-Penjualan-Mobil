<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\TipeController;
use App\Http\Controllers\Backend\MobilController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Publik & Pelanggan)
|--------------------------------------------------------------------------
*/

Route::middleware(['tolak_admin'])->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('beranda');
    Route::get('/mobil/{id}', [FrontendController::class, 'show'])->name('detail.mobil');
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/mobil/{id}/booking', [FrontendController::class, 'booking'])->name('booking.mobil');
    Route::post('/booking/store', [FrontendController::class, 'bookingStore'])->name('booking.store');
    Route::get('/booking/cancel/{kodeBooking}', [FrontendController::class, 'bookingCancel'])->name('booking.cancel'); // TAMBAHAN
    Route::get('/pesanan-saya', [FrontendController::class, 'pesananSaya'])->name('pesanan.saya');

    Route::get('/profil', [FrontendController::class, 'profil'])->name('profil.index');
    Route::put('/profil/update', [FrontendController::class, 'profilUpdate'])->name('profil.update');
});

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login & Logout)
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store')->middleware('guest');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('backend.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('backend.logout');

/*
|--------------------------------------------------------------------------
| BACKEND ROUTES (Khusus Admin & Super Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:0,1'])->prefix('backend')->name('backend.')->group(function () {
    Route::get('/beranda', function () {
        $total_mobil = \App\Models\Mobil::count();
        $total_pesanan = \App\Models\Transaksi::count();
        $total_user = \App\Models\User::where('role', 2)->count();
        $total_pendapatan = \App\Models\Transaksi::where('status', 'Selesai')->sum('booking_fee');

        $tipeTerlaris = \Illuminate\Support\Facades\DB::table('transaksis')
            ->join('mobils', 'transaksis.mobil_id', '=', 'mobils.id')
            ->join('tipes', 'mobils.tipe_id', '=', 'tipes.id')
            ->select('tipes.nama_tipe', \Illuminate\Support\Facades\DB::raw('count(transaksis.id) as jumlah'))
            ->groupBy('tipes.id', 'tipes.nama_tipe')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        $label_tipe = $tipeTerlaris->pluck('nama_tipe');
        $data_tipe = $tipeTerlaris->pluck('jumlah');

        if ($label_tipe->isEmpty()) {
            $label_tipe = ['Belum Ada Penjualan'];
            $data_tipe = [1];
        }

        $label_bulan = [];
        $data_penjualan = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = \Carbon\Carbon::now()->subMonths($i);
            $label_bulan[] = $bulan->translatedFormat('F Y');

            $jumlahPesanan = \App\Models\Transaksi::whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();
            $data_penjualan[] = $jumlahPesanan;
        }

        return view('backend.v_beranda.index', [
            'judul'          => 'Dashboard Statistik',
            'total_mobil'    => $total_mobil,
            'total_pesanan'  => $total_pesanan,
            'total_user'     => $total_user,
            'total_pendapatan' => $total_pendapatan,
            'label_tipe'     => $label_tipe,
            'data_tipe'      => $data_tipe,
            'label_bulan'    => $label_bulan,
            'data_penjualan' => $data_penjualan,
        ]);
    })->name('beranda');

    Route::resource('tipe', TipeController::class);
    Route::resource('mobil', MobilController::class);

    Route::get('/pesanan', [\App\Http\Controllers\Backend\PesananController::class, 'index'])->name('pesanan.index');
    Route::put('/pesanan/{id}/status', [\App\Http\Controllers\Backend\PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::get('/pesanan/cetak-pdf', [\App\Http\Controllers\Backend\PesananController::class, 'cetakPdf'])->name('pesanan.pdf');
    Route::get('/pesanan/cetak-excel', [\App\Http\Controllers\Backend\PesananController::class, 'cetakExcel'])->name('pesanan.excel');
});

Route::middleware(['auth', 'role:1'])->prefix('backend')->name('backend.')->group(function () {
    Route::resource('user', \App\Http\Controllers\Backend\UserController::class);
});
