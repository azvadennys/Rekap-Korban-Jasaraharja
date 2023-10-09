<?php

use App\Http\Controllers\balasanControler;
use App\Http\Controllers\diskusiControler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [diskusiControler::class, 'index'])->name('/');
// Route::post('/', [diskusiControler::class, 'store'])->name('diskusi.tambah');
// Route::get('/detail/{id}', [diskusiControler::class, 'show'])->name('diskusi.detail');
// Route::post('/detail/balasan', [balasanControler::class, 'store'])->name('balasan.tambah');

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\korbanControler;
use App\Http\Controllers\LaporanControler;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/korban', [korbanControler::class, 'index'])->name('korban')->middleware('auth');
Route::get('/korban/create', [korbanControler::class, 'create'])->name('korban.create')->middleware('auth');
Route::post('/korban/store', [korbanControler::class, 'store'])->name('korban.store')->middleware('auth');
Route::get('/korban/{id}', [korbanControler::class, 'edit'])->name('korban.edit')->middleware('auth');
Route::post('/korban/{id}', [korbanControler::class, 'update'])->name('korban.update')->middleware('auth');
Route::delete('/korban/delete/{id}', [korbanControler::class, 'destroy'])->name('korban.destroy')->middleware('auth');

Route::get('/laporan', [LaporanControler::class, 'index'])->name('laporan')->middleware('auth');
Route::post('/laporan-cetak', [LaporanControler::class, 'cetak'])->name('laporan.cetak')->middleware('auth');

// Route untuk mengaktifkan mode maintenance
Route::get('/maintenance/on', function () {
	$secretCode = 'azvadenTech'; // Ganti dengan secret code yang sesuai
	$message = '*Project: SI Jasaraharja*' . PHP_EOL .
		'_Website dalam mode Maintenance_❌' . PHP_EOL .
		'Domain: ' . request()->getHttpHost() . PHP_EOL .
		'Secret Code: ' . $secretCode;
	$chat_id = '5163645049'; // Ganti dengan ID chat yang sesuai

	Telegram::sendMessage([
		'chat_id' => $chat_id,
		'text' => $message,
		'parse_mode' => 'Markdown',
	]);

	Artisan::call("down --secret={$secretCode}");


	return redirect('/dashboard');
});

// Route untuk menonaktifkan mode maintenance
Route::get('/maintenance/off', function () {
	Artisan::call('up');
	$message = '*Project: SI Jasaraharja*' . PHP_EOL .
		'_Website dalam mode Non-Maintenance_✅' . PHP_EOL .
		'Domain: ' . request()->getHttpHost();
	$chat_id = '5163645049'; // Ganti dengan ID chat yang sesuai

	Telegram::sendMessage([
		'chat_id' => $chat_id,
		'text' => $message,
		'parse_mode' => 'Markdown',
	]);
	return  redirect('/dashboard');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
