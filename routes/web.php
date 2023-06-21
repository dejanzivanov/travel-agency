<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DependentsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
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
Route::post('/insurance-request', [InsuranceController::class, 'insurancePurchase'])->name('insurance-purchase');

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
    Route::post('/update-blog', [BlogController::class, 'updateBlog'])->name('update-blog');
    Route::post('/upload', [FileController::class, 'upload'])->name('upload');
    Route::post('/create-post', [BlogController::class, 'createPost'])->name('create-post');
    Route::post('/insurance-data', [InsuranceController::class, 'getAllInsurancesPostRequestDataTable'])->name('insurance-data-table-request');
    Route::get('dependents/{id}', [DependentsController::class, 'dependentsView'])->name('dependents');
    Route::post('/users-data', [UserController::class, 'getAllUsersPostRequestDataTable'])->name('users-data-table-request');
    Route::post('/user-delete', [UserController::class, 'deleteUser'])->name('user-delete');
    Route::post('/create-user', [UserController::class, 'createUser'])->name('create-user');
    Route::post('/user/{id}', [UserController::class, 'getUserDataById'])->name('user-data');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('update-user');
});

Route::get('/idiot', function () {
    return view('idiot');
});
