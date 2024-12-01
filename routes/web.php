<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\auth\AuthController as AdminAuthController;

use App\Http\Controllers\admin\AdminMoviesController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');

//auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'store'])->name('register');

//movies routes
Route::get('/movies', [MoviesController::class, 'index'])->name('movies');
Route::get('/movies/{slug}', [MoviesController::class, 'show'])->name('movies.show');
Route::get('watch/{slug}', [MoviesController::class, 'watch'])->name('movies.watch');
Route::get('watch/{slug}/{episode}', [MoviesController::class, 'watch'])->name('movies.watch.espiode');
Route::get('/search', [MoviesController::class, 'search'])->name('movies.search');

Route::get('categories', [CategoriesController::class, 'category'])->name('movies.category');
Route::get('categories/{slug}', [CategoriesController::class, 'show'])->name('movies.category.show');
Route::get('categories/{slug}/{page}', [CategoriesController::class, 'show'])->name('movies.category.show.page');

Route::prefix('admin')->name('admin.')->group(function(){
    //auth admin
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');



    //movies admin
    Route::get('/movies', [AdminMoviesController::class, 'index'])->name('movies');
    Route::get('/movies/create', [AdminMoviesController::class, 'create'])->name('movies.create');
    Route::post('/movies/store', [AdminMoviesController::class, 'store'])->name('movies.store');
    Route::get('/movies/edit/{id}', [AdminMoviesController::class, 'edit'])->name('movies.edit');
    Route::post('/movies/update/{id}', [AdminMoviesController::class, 'update'])->name('movies.update');
    Route::get('/movies/delete/{id}', [AdminMoviesController::class, 'delete'])->name('movies.delete');
});



