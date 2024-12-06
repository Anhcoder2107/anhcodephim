<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\auth\AuthController as AdminAuthController;

use App\Http\Controllers\admin\AdminMoviesController;
use App\Http\Controllers\admin\AdminCategoriesController;
use App\Http\Controllers\admin\EpisodesController;


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
    Route::post('/episodes/store/{id}', [EpisodesController::class, 'storeEspiode'])->name('episodes.store');
    Route::get('/episodes/edit/{id}', [EpisodesController::class, 'editEspiode'])->name('episodes.edit');
    Route::post('/episodes/update/{id}', [EpisodesController::class, 'updateEspiode'])->name('episodes.update');
    Route::post('/episodes/delete/{id}', [EpisodesController::class, 'deleteEspiode'])->name('epiodes.delete');

    //categories admin
    Route::get('/categories', [AdminMoviesController::class, 'categories'])->name('categories');
    Route::get('/categories/create', [AdminMoviesController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories/store', [AdminMoviesController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/edit/{id}', [AdminMoviesController::class, 'editCategory'])->name('categories.edit');
    Route::post('/categories/update/{id}', [AdminMoviesController::class, 'updateCategory'])->name('categories.update');
    Route::post('/categories/delete/{id}', [AdminMoviesController::class, 'deleteCategory'])->name('categories.delete');

    //users admin
    Route::get('/users', [AdminMoviesController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminMoviesController::class, 'createUser'])->name('users.create');
    Route::post('/users/store', [AdminMoviesController::class, 'storeUser'])->name('users.store');
    Route::get('/users/edit/{id}', [AdminMoviesController::class, 'editUser'])->name('users.edit');
    Route::post('/users/update/{id}', [AdminMoviesController::class, 'updateUser'])->name('users.update');
    Route::post('/users/delete/{id}', [AdminMoviesController::class, 'deleteUser'])->name('users.delete');

    //directors admin
    Route::get('/directors', [AdminMoviesController::class, 'directors'])->name('directors');
    Route::get('/directors/create', [AdminMoviesController::class, 'createDirector'])->name('directors.create');
    Route::post('/directors/store', [AdminMoviesController::class, 'storeDirector'])->name('directors.store');
    Route::get('/directors/edit/{id}', [AdminMoviesController::class, 'editDirector'])->name('directors.edit');
    Route::post('/directors/update/{id}', [AdminMoviesController::class, 'updateDirector'])->name('directors.update');
    Route::post('/directors/delete/{id}', [AdminMoviesController::class, 'deleteDirector'])->name('directors.delete');

    //actors admin
    Route::get('/actors', [AdminMoviesController::class, 'actors'])->name('actors');
    Route::get('/actors/create', [AdminMoviesController::class, 'createActor'])->name('actors.create');
    Route::post('/actors/store', [AdminMoviesController::class, 'storeActor'])->name('actors.store');
    Route::get('/actors/edit/{id}', [AdminMoviesController::class, 'editActor'])->name('actors.edit');
    Route::post('/actors/update/{id}', [AdminMoviesController::class, 'updateActor'])->name('actors.update');
    Route::post('/actors/delete/{id}', [AdminMoviesController::class, 'deleteActor'])->name('actors.delete');


    //permissions admin
    Route::get('/permissions', [AdminMoviesController::class, 'permissions'])->name('permissions');
    Route::get('/permissions/create', [AdminMoviesController::class, 'createPermission'])->name('permissions.create');
    Route::post('/permissions/store', [AdminMoviesController::class, 'storePermission'])->name('permissions.store');
    Route::get('/permissions/edit/{id}', [AdminMoviesController::class, 'editPermission'])->name('permissions.edit');
    Route::post('/permissions/update/{id}', [AdminMoviesController::class, 'updatePermission'])->name('permissions.update');
    Route::post('/permissions/delete/{id}', [AdminMoviesController::class, 'deletePermission'])->name('permissions.delete');

    //roles admin
    Route::get('/roles', [AdminMoviesController::class, 'roles'])->name('roles');
    Route::get('/roles/create', [AdminMoviesController::class, 'createRole'])->name('roles.create');
    Route::post('/roles/store', [AdminMoviesController::class, 'storeRole'])->name('roles.store');
    Route::get('/roles/edit/{id}', [AdminMoviesController::class, 'editRole'])->name('roles.edit');
    Route::post('/roles/update/{id}', [AdminMoviesController::class, 'updateRole'])->name('roles.update');
    Route::post('/roles/delete/{id}', [AdminMoviesController::class, 'deleteRole'])->name('roles.delete');
});



