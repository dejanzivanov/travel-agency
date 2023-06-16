<?php

use App\Http\Controllers\AdminController;
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

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logoutPost'])->name('logout.post');


//Route::group(['middleware' => 'auth'], function () {
//    Route::get('/admin-dashboard', function () {
//        return view('admin-dashboard');
//    })->name('admin-dashboard');
//});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin-dashboard', function () {
        return view('admin-dashboard');
    })->name('admin-dashboard');

    Route::post('/blog-data', [BlogController::class, 'getBlogDataFromControllerPostRequest'])->name('blog-data');
    Route::post('/blog-data-delete', [BlogController::class, 'deleteBlogDataFromControllerPostRequest'])->name('blog-data-delete');
    Route::get('/blog-data-update/{id}/', [BlogController::class, 'updateBlogDataFromControllerPostRequest'])->name('blog-data-update');
});
Route::get('/idiot', function () {
    return view('idiot');
});
