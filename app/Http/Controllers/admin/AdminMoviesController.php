<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Movies;

class AdminMoviesController extends Controller
{
    //


    public function index(){

        $movies = Movies::paginate(10);
        // dd($movies);
        $total_pages = $movies->lastPage();
        $current_page = $movies->currentPage();
        $path = $movies->path();


        return view('admin.pages.movies.index', compact('movies', 'total_pages', 'current_page', 'path'));
    }
}
