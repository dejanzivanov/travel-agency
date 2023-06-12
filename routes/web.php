<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');

Route::get('/blog', [BlogController::class, 'getBlogDataFromController']);

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');

Route::get('/register', [RegistrationController::class, 'register'])->name('register');
Route::post('/register', [RegistrationController::class, 'registerPost'])->name('register.post');

Route::get('/insurance-purchase', [InsuranceController::class, 'insurance']);



