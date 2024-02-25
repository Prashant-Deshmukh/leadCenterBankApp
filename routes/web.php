<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('login', [UserController::class, 'index'])->name('login');
Route::post('custom-login', [UserController::class, 'customLogin'])->name('login.custom');
Route::get('register', [UserController::class, 'registration'])->name('register');
Route::post('custom-registration', [UserController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [UserController::class, 'signOut'])->name('signout');

Route::get('deposite', [UserController::class, 'deposite'])->name('deposite');
Route::post('deposite-amount', [UserController::class, 'depositeAmount'])->name('deposite.amount');

Route::get('withdraw', [UserController::class, 'withdraw'])->name('withdraw');
Route::post('withdraw-amount', [UserController::class, 'withdrawAmount'])->name('withdraw.amount');

Route::get('transfer', [UserController::class, 'transfer'])->name('transfer');
Route::post('transfer-amount', [UserController::class, 'transferAmount'])->name('transfer.amount');

