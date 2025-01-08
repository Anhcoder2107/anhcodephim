<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\RegionsController;

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\auth\AuthController as AdminAuthController;

use App\Http\Controllers\admin\AdminMoviesController;
use App\Http\Controllers\admin\EpisodesController;
use App\Http\Controllers\admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\admin\ActorsController;
use App\Http\Controllers\admin\DirectorsController;
use App\Http\Controllers\admin\RegionsController as AdminRegionsController;
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

//logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//login with facebook
Route::get('/facebook', [AuthController::class, 'login'])->name('facebook');
Route::get('/facebook/callback', [AuthController::class, 'login'])->name('facebook.callback');




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

//Regions routes
Route::get('regions/{slug}', [RegionsController::class, 'show'])->name('movies.region.show');
Route::get('regions/{slug}/{page}', [RegionsController::class, 'show'])->name('movies.region.show.page');




//admin routes
Route::get('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'auth'])->name('admin.login');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    //home admin
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    //movies admin
    Route::group(['middleware' => ['permission:Browse movie']], function () {
        Route::get('/movies', [AdminMoviesController::class, 'index'])->name('movies');
    });
    Route::group(['middleware' => ['permission:Create movie']], function () {
        Route::get('/movies/create', [AdminMoviesController::class, 'create'])->name('movies.create');
        Route::post('/movies/store', [AdminMoviesController::class, 'store'])->name('movies.store');
    });
    Route::group(['middleware' => ['permission:Update movie']], function () {
        Route::get('/movies/edit/{id}', [AdminMoviesController::class, 'edit'])->name('movies.edit');
        Route::post('/movies/update/{id}', [AdminMoviesController::class, 'update'])->name('movies.update');
    });
    Route::group(['middleware' => ['permission:Delete movie']], function () {
        Route::post('/movies/delete/{id}', [AdminMoviesController::class, 'delete'])->name('movies.delete');
    });

    //episodes admin
    Route::group(['middleware' => ['permission:Browse episode']], function () {
        Route::get('episodes', [EpisodesController::class, 'index'])->name('espiodes');
        Route::get('episodes/{id}', [EpisodesController::class, 'episodeByMovie'])->name('episodes.movie_id');
    });
    Route::group(['middleware' => ['permission:Create episode']], function () {
        Route::get('episodes/create/{id}', [EpisodesController::class, 'create'])->name('episodes.create');
        Route::post('episodes/store/{id}', [EpisodesController::class, 'store'])->name('episodes.store');
    });
    Route::group(['middleware' => ['permission:Update episode']], function () {
        Route::get('episodes/edit/{id}', [EpisodesController::class, 'edit'])->name('episodes.edit');
        Route::post('episodes/update/{id}', [EpisodesController::class, 'update'])->name('episodes.update');
    });
    Route::group(['middleware' => ['permission:Delete episode']], function () {
        Route::post('episodes/delete/{id}', [EpisodesController::class, 'delete'])->name('episodes.delete');
    });

    //categories admin
    Route::group(['middleware' => ['permission:Browse category']], function () {
        Route::get('categories', [AdminCategoriesController::class, 'index'])->name('categories');
    });
    Route::group(['middleware' => ['permission:Create category']], function () {
        Route::get('categories/create', [AdminCategoriesController::class, 'create'])->name('categories.create');
        Route::post('categories/store', [AdminCategoriesController::class, 'store'])->name('categories.store');
    });
    Route::group(['middleware' => ['permission:Update category']], function () {
        Route::get('categories/edit/{id}', [AdminCategoriesController::class, 'edit'])->name('categories.edit');
        Route::post('categories/update/{id}', [AdminCategoriesController::class, 'update'])->name('categories.update');
    });
    Route::group(['middleware' => ['permission:Delete category']], function () {
        Route::post('categories/delete/{id}', [AdminCategoriesController::class, 'delete'])->name('categories.delete');
    });
    Route::get('categories/show/{id}', [AdminCategoriesController::class, 'show'])->name('categories.movie_id');
    Route::get('categories/add/{id}', [AdminCategoriesController::class, 'addGet'])->name('categories.add');
    Route::post('categories/add/{id}', [AdminCategoriesController::class, 'addPost'])->name('categories.add.post');
    Route::post('categories/delete/{id}/{movie_id}', [AdminCategoriesController::class, 'deleteCategory'])->name('categories.delete.post');

    //directors admin
    Route::group(['middleware' => ['permission:Browse director']], function () {
        Route::get('directors', [DirectorsController::class, 'index'])->name('directors');
    });
    Route::group(['middleware' => ['permission:Create director']], function () {
        Route::get('directors/create', [DirectorsController::class, 'create'])->name('directors.create');
        Route::post('directors/store', [DirectorsController::class, 'store'])->name('directors.store');
    });
    Route::group(['middleware' => ['permission:Update director']], function () {
        Route::get('directors/edit/{id}', [DirectorsController::class, 'edit'])->name('directors.edit');
        Route::post('directors/update/{id}', [DirectorsController::class, 'update'])->name('directors.update');
    });
    Route::group(['middleware' => ['permission:Delete director']], function () {
        Route::post('directors/delete/{id}', [DirectorsController::class, 'delete'])->name('directors.delete');
    });
    Route::group(['middleware' => ['permission:Movie Has Director']], function () {
        Route::get('directors/show/{id}', [DirectorsController::class, 'directorByMovie'])->name('directors.movie_id');
        Route::get('directors/add/{id}', [DirectorsController::class, 'addGet'])->name('directors.add');
        Route::post('directors/add/{id}', [DirectorsController::class, 'addPost'])->name('directors.add.post');
        Route::post('directors/delete/{id}/{movie_id}', [DirectorsController::class, 'deleteDirector'])->name('directors.delete.post');
    });

    //actors admin
    Route::group(['middleware' => ['permission:Browse actor']], function () {
        Route::get('actors', [ActorsController::class, 'index'])->name('actors');
    });
    Route::group(['middleware' => ['permission:Create actor']], function () {
        Route::get('actors/create', [ActorsController::class, 'create'])->name('actors.create');
        Route::post('actors/store', [ActorsController::class, 'store'])->name('actors.store');
    });
    Route::group(['middleware' => ['permission:Update actor']], function () {
        Route::get('actors/edit/{id}', [ActorsController::class, 'edit'])->name('actors.edit');
        Route::post('actors/update/{id}', [ActorsController::class, 'update'])->name('actors.update');
    });
    Route::group(['middleware' => ['permission:Delete actor']], function () {
        Route::post('actors/delete/{id}', [ActorsController::class, 'delete'])->name('actors.delete');
    });
    Route::group(['middleware' => ['permission:Movie Has Actor']], function () {
        Route::get('actors/show/{id}', [ActorsController::class, 'show'])->name('actors.movie_id');
        Route::get('actors/add/{id}', [ActorsController::class, 'addGet'])->name('actors.add');
        Route::post('actors/add/{id}', [ActorsController::class, 'addPost'])->name('actors.add.post');
        Route::post('actors/delete/{id}/{movie_id}', [ActorsController::class, 'deleteActor'])->name('actors.delete.post');
    });

    //regions admin
    Route::group(['middleware' => ['permission:Browse region']], function () {
        Route::get('regions', [AdminRegionsController::class, 'index'])->name('regions');
    });
    Route::group(['middleware' => ['permission:Create region']], function () {
        Route::get('regions/create', [AdminRegionsController::class, 'create'])->name('regions.create');
        Route::post('regions/store', [AdminRegionsController::class, 'store'])->name('regions.store');
    });
    Route::group(['middleware' => ['permission:Update region']], function () {
        Route::get('regions/edit/{id}', [AdminRegionsController::class, 'edit'])->name('regions.edit');
        Route::post('regions/update/{id}', [AdminRegionsController::class, 'update'])->name('regions.update');
    });
    Route::group(['middleware' => ['permission:Delete region']], function () {
        Route::post('regions/delete/{id}', [AdminRegionsController::class, 'delete'])->name('regions.delete');
    });
    Route::group(['middleware' => ['permission:Movie Has Region']], function () {
        Route::get('regions/show/{id}', [AdminRegionsController::class, 'show'])->name('regions.movie_id');
        Route::get('regions/add/{id}', [AdminRegionsController::class, 'addGet'])->name('regions.add');
        Route::post('regions/add/{id}', [AdminRegionsController::class, 'addPost'])->name('regions.add.post');
        Route::post('regions/delete/{id}/{movie_id}', [AdminRegionsController::class, 'deleteRegion'])->name('regions.delete.post');
    });

    //users admin
    Route::group(['middleware' => ['permission:Browse user']], function () {
        Route::get('users', [UsersController::class, 'index'])->name('users');
    });
    Route::group(['middleware' => ['permission:Create user']], function () {
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
    });
    Route::group(['middleware' => ['permission:Update user']], function () {
        Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    });
    Route::group(['middleware' => ['permission:Delete user']], function () {
        Route::post('users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');
    });
    Route::group(['middleware' => ['permission:Model Has Role']], function () {
        Route::get('users/addRole/{id}', [UsersController::class, 'addGet'])->name('users.add');
        Route::post('users/addRole/{id}', [UsersController::class, 'addPost'])->name('users.add.post');
    });
    Route::group(['middleware' => ['permission:Model Has Permission']], function () {
        Route::get('users/permissions/{id}', [UsersController::class, 'addPermissions'])->name('users.permissions');
        Route::post('users/permissions/{id}', [UsersController::class, 'addPermissionsPost'])->name('users.permissions.post');
        Route::get('users/show/permissions/{id}', [UsersController::class, 'showPermissions'])->name('users.show.permissions');
    });

    //permissions admin
    Route::group(['middleware' => ['permission:Browse permission']], function () {
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
    });
    Route::group(['middleware' => ['permission:Create permission']], function () {
        Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    });
    Route::group(['middleware' => ['permission:Update permission']], function () {
        Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    });
    Route::group(['middleware' => ['permission:Delete permission']], function () {
        Route::post('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');
    });
    Route::group(['middleware' => ['permission:Role Has Permission']], function () {
        Route::get('permissions/addRole/{id}', [PermissionController::class, 'addGet'])->name('permissions.add');
        Route::post('permissions/addRole/{id}', [PermissionController::class, 'addPost'])->name('permissions.add.post');
    });

    //roles admin
    Route::group(['middleware' => ['permission:Browse role']], function () {
        Route::get('roles', [RoleController::class, 'index'])->name('roles');
    });
    Route::group(['middleware' => ['permission:Create role']], function () {
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    });
    Route::group(['middleware' => ['permission:Update role']], function () {
        Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    });
    Route::group(['middleware' => ['permission:Delete role']], function () {
        Route::post('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    });
    Route::group(['middleware' => ['permission:Role Has Permission']], function () {
        Route::get('roles/addPermission/{id}', [RoleController::class, 'addGet'])->name('roles.add');
        Route::post('roles/addPermission/{id}', [RoleController::class, 'addPost'])->name('roles.add.post');
    });
});



