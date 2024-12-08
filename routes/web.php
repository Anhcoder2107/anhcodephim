<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\auth\AuthController as AdminAuthController;

use App\Http\Controllers\admin\AdminMoviesController;
use App\Http\Controllers\admin\EpisodesController;
use App\Http\Controllers\admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\admin\ActorsController;
use App\Http\Controllers\admin\DirectorsController;
use App\Http\Controllers\admin\RegionsController;


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

//categories routes
Route::get('categories', [CategoriesController::class, 'category'])->name('movies.category');
Route::get('categories/{slug}', [CategoriesController::class, 'show'])->name('movies.category.show');
Route::get('categories/{slug}/{page}', [CategoriesController::class, 'show'])->name('movies.category.show.page');


//admin routes
Route::get('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'auth'])->name('admin.login');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){

    //home admin
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    //movies admin
    Route::get('/movies', [AdminMoviesController::class, 'index'])->name('movies');
    Route::get('/movies/create', [AdminMoviesController::class, 'create'])->name('movies.create');
    Route::post('/movies/store', [AdminMoviesController::class, 'store'])->name('movies.store');
    Route::get('/movies/edit/{id}', [AdminMoviesController::class, 'edit'])->name('movies.edit');
    Route::post('/movies/update/{id}', [AdminMoviesController::class, 'update'])->name('movies.update');
    Route::post('/movies/delete/{id}', [AdminMoviesController::class, 'delete'])->name('movies.delete');


    //episodes admin
    Route::get('episodes', [EpisodesController::class, 'index'])->name('espiodes');
    Route::get('episodes/{id}', [EpisodesController::class, 'episodeByMovie'])->name('episodes.movie_id');
    Route::get('episodes/create/{id}', [EpisodesController::class, 'create'])->name('episodes.create');
    Route::post('episodes/store/{id}', [EpisodesController::class, 'store'])->name('episodes.store');
    Route::get('episodes/edit/{id}', [EpisodesController::class, 'edit'])->name('episodes.edit');
    Route::post('episodes/update/{id}', [EpisodesController::class, 'update'])->name('episodes.update');
    Route::post('episodes/delete/{id}', [EpisodesController::class, 'delete'])->name('episodes.delete');

    //categories admin
    Route::get('categories', [AdminCategoriesController::class, 'index'])->name('categories');
    Route::get('categories/create', [AdminCategoriesController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [AdminCategoriesController::class, 'store'])->name('categories.store');
    Route::get('categories/edit/{id}', [AdminCategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('categories/update/{id}', [AdminCategoriesController::class, 'update'])->name('categories.update');
    Route::post('categories/delete/{id}', [AdminCategoriesController::class, 'delete'])->name('categories.delete');

    //users admin
    Route::get('users', [AdminMoviesController::class, 'users'])->name('users');
    Route::get('users/create', [AdminMoviesController::class, 'createUser'])->name('users.create');
    Route::post('users/store', [AdminMoviesController::class, 'storeUser'])->name('users.store');
    Route::get('users/edit/{id}', [AdminMoviesController::class, 'editUser'])->name('users.edit');
    Route::post('users/update/{id}', [AdminMoviesController::class, 'updateUser'])->name('users.update');
    Route::post('users/delete/{id}', [AdminMoviesController::class, 'deleteUser'])->name('users.delete');

    //directors admin
    Route::get('directors', [DirectorsController::class, 'index'])->name('directors');
    Route::get('directors/create', [DirectorsController::class, 'create'])->name('directors.create');
    Route::post('directors/store', [DirectorsController::class, 'store'])->name('directors.store');
    Route::get('directors/edit/{id}', [DirectorsController::class, 'edit'])->name('directors.edit');
    Route::post('directors/update/{id}', [DirectorsController::class, 'update'])->name('directors.update');
    Route::post('directors/delete/{id}', [DirectorsController::class, 'delete'])->name('directors.delete');

    //actors admin
    Route::get('actors', [ActorsController::class, 'index'])->name('actors');
    Route::get('actors/create', [ActorsController::class, 'create'])->name('actors.create');
    Route::post('actors/store', [ActorsController::class, 'store'])->name('actors.store');
    Route::get('actors/edit/{id}', [ActorsController::class, 'edit'])->name('actors.edit');
    Route::post('actors/update/{id}', [ActorsController::class, 'update'])->name('actors.update');
    Route::post('actors/delete/{id}', [ActorsController::class, 'delete'])->name('actors.delete');

    //regions admin
    Route::get('regions', [RegionsController::class, 'index'])->name('regions');
    Route::get('regions/create', [RegionsController::class, 'create'])->name('regions.create');
    Route::post('regions/store', [RegionsController::class, 'store'])->name('regions.store');
    Route::get('regions/edit/{id}', [RegionsController::class, 'edit'])->name('regions.edit');
    Route::post('regions/update/{id}', [RegionsController::class, 'update'])->name('regions.update');
    Route::post('regions/delete/{id}', [RegionsController::class, 'delete'])->name('regions.delete');

    //permissions admin
    Route::get('permissions', [AdminMoviesController::class, 'index'])->name('permissions');
    Route::get('permissions/create', [AdminMoviesController::class, 'create'])->name('permissions.create');
    Route::post('permissions/store', [AdminMoviesController::class, 'store'])->name('permissions.store');
    Route::get('permissions/edit/{id}', [AdminMoviesController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update/{id}', [AdminMoviesController::class, 'update'])->name('permissions.update');
    Route::post('permissions/delete/{id}', [AdminMoviesController::class, 'delete'])->name('permissions.delete');

    //roles admin
    Route::get('roles', [AdminMoviesController::class, 'index'])->name('roles');
    Route::get('roles/create', [AdminMoviesController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [AdminMoviesController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{id}', [AdminMoviesController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update/{id}', [AdminMoviesController::class, 'update'])->name('roles.update');
    Route::post('roles/delete/{id}', [AdminMoviesController::class, 'delete'])->name('roles.delete');
});



