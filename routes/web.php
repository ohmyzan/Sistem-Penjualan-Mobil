<?php 
 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\BerandaController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MerkController;

// Redirect ke login
Route::get('/', function () { 
    return redirect()->route('backend.login'); 
}); 

// LOGIN
Route::get('backend/login', [LoginController::class, 'loginBackend'])
    ->name('backend.login'); 

Route::post('backend/login', [LoginController::class, 'authenticateBackend'])
    ->name('backend.login.post'); 

Route::get('backend/logout', [LoginController::class, 'logoutBackend'])
    ->name('backend.logout');

// USER (Anggota)
Route::resource('backend/user', AnggotaController::class ,['as' => 'backend'])
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {

    // === Dashboard ===
    Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
        ->name('backend.beranda');

    // === Data Mobil === 
    Route::resource('backend/mobil', MobilController::class, ['as' => 'backend']);

    // === Data Merk ===
   Route::resource('backend/merk', MerkController::class, ['as' => 'backend']);


});
