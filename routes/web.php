<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DependentsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPreviewController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/post/{id}', [PostController::class, 'getPostById'])->name('post');
Route::get('/post-preview/', [PostController::class, 'returnViewPost'])->name('post');
Route::post('/post-preview1/', function(Request $request) {


        $title = $request->input('title');
        $description = $request->input('description');
        $bodyText = $request->input('bodyText');
        $image_name = $request->input('file.name');
        $type = $request->input('type');
        $status = $request->input('status');
        $file = $request->input('file');
        $image_path = $request->input('image_path');

//        session(['$title' => $title]);
//        session(['$description' => $description]);
//        session(['$bodyText' => $bodyText]);
//        session(['$image_name' => $image_name]);
//        session(['$type' => $type]);
//        session(['$file' => $file]);
//        session(['$status' => $status]);

        session(['title' => '']);
        session(['description' => '']);
        session(['bodyText' => '']);
        session(['image_name' => '']);
        session(['image_path' => '']);
        session(['type' => '']);
        session(['file' => '']);
        session(['status' => '']);

        $request->session()->put('title', $title);
        $request->session()->put('description', $description);
        $request->session()->put('bodyText', $bodyText);
        $request->session()->put('image_name', $image_name);
        $request->session()->put('image_path', $image_path);
        $request->session()->put('type', $type);
        $request->session()->put('file', $file);
        $request->session()->put('status', $status);
//        dd(session('$bodyText'));
//            return view('post-preview');
        return response()->json(['message' => 'Variable added to session']);
});


Route::get('/idiot', function () {
    return view('idiot');
});
