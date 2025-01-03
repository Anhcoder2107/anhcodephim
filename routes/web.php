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
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;


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
    Route::group(['middleware' => ['can:Browse episode']], function(){
        Route::get('episodes', [EpisodesController::class, 'index'])->name('espiodes');
    });
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

    Route::get('categories/show/{id}', [AdminCategoriesController::class, 'show'])->name('categories.movie_id');
    Route::get('categories/add/{id}', [AdminCategoriesController::class, 'addGet'])->name('categories.add');
    Route::post('categories/add/{id}', [AdminCategoriesController::class, 'addPost'])->name('categories.add.post');
    Route::post('categories/delete/{id}/{movie_id}', [AdminCategoriesController::class, 'deleteCategory'])->name('categories.delete.post');

    //users admin
    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::post('users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

    Route::get('users/addRole/{id}', [UsersController::class, 'addGet'])->name('users.add');
    Route::post('users/addRole/{id}', [UsersController::class, 'addPost'])->name('users.add.post');
    Route::get('users/permissions/{id}', [UsersController::class, 'addPermissions'])->name('users.permissions');
    Route::post('users/permissions/{id}', [UsersController::class, 'addPermissionsPost'])->name('users.permissions.post');
    Route::get('users/show/permissions/{id}', [UsersController::class, 'showPermissions'])->name('users.show.permissions');

    //directors admin
    Route::get('directors', [DirectorsController::class, 'index'])->name('directors');
    Route::get('directors/create', [DirectorsController::class, 'create'])->name('directors.create');
    Route::post('directors/store', [DirectorsController::class, 'store'])->name('directors.store');
    Route::get('directors/edit/{id}', [DirectorsController::class, 'edit'])->name('directors.edit');
    Route::post('directors/update/{id}', [DirectorsController::class, 'update'])->name('directors.update');
    Route::post('directors/delete/{id}', [DirectorsController::class, 'delete'])->name('directors.delete');

    Route::get('directors/show/{id}', [DirectorsController::class, 'directorByMovie'])->name('directors.movie_id');
    Route::get('directors/add/{id}', [DirectorsController::class, 'addGet'])->name('directors.add');
    Route::post('directors/add/{id}', [DirectorsController::class, 'addPost'])->name('directors.add.post');
    Route::post('directors/delete/{id}/{movie_id}', [DirectorsController::class, 'deleteDirector'])->name('directors.delete.post');

    //actors admin
    Route::get('actors', [ActorsController::class, 'index'])->name('actors');
    Route::get('actors/create', [ActorsController::class, 'create'])->name('actors.create');
    Route::post('actors/store', [ActorsController::class, 'store'])->name('actors.store');
    Route::get('actors/edit/{id}', [ActorsController::class, 'edit'])->name('actors.edit');
    Route::post('actors/update/{id}', [ActorsController::class, 'update'])->name('actors.update');
    Route::post('actors/delete/{id}', [ActorsController::class, 'delete'])->name('actors.delete');

    Route::get('actors/show/{id}', [ActorsController::class, 'show'])->name('actors.movie_id');
    Route::get('actors/add/{id}', [ActorsController::class, 'addGet'])->name('actors.add');
    Route::post('actors/add/{id}', [ActorsController::class, 'addPost'])->name('actors.add.post');
    Route::post('actors/delete/{id}/{movie_id}', [ActorsController::class, 'deleteActor'])->name('actors.delete.post');



    //regions admin
    Route::get('regions', [RegionsController::class, 'index'])->name('regions');
    Route::get('regions/create', [RegionsController::class, 'create'])->name('regions.create');
    Route::post('regions/store', [RegionsController::class, 'store'])->name('regions.store');
    Route::get('regions/edit/{id}', [RegionsController::class, 'edit'])->name('regions.edit');
    Route::post('regions/update/{id}', [RegionsController::class, 'update'])->name('regions.update');
    Route::post('regions/delete/{id}', [RegionsController::class, 'delete'])->name('regions.delete');

    Route::get('regions/show/{id}', [RegionsController::class, 'show'])->name('regions.movie_id');
    Route::get('regions/add/{id}', [RegionsController::class, 'addGet'])->name('regions.add');
    Route::post('regions/add/{id}', [RegionsController::class, 'addPost'])->name('regions.add.post');
    Route::post('regions/delete/{id}/{movie_id}', [RegionsController::class, 'deleteRegion'])->name('regions.delete.post');

    //permissions admin
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');

    Route::get('permissions/addRole/{id}', [PermissionController::class, 'addGet'])->name('permissions.add');
    Route::post('permissions/addRole/{id}', [PermissionController::class, 'addPost'])->name('permissions.add.post');

    //roles admin
    Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::post('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');

    Route::get('roles/addPermission/{id}', [RoleController::class, 'addGet'])->name('roles.add');
    Route::post('roles/addPermission/{id}', [RoleController::class, 'addPost'])->name('roles.add.post');

});



