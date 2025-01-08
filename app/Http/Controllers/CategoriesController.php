<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Movies;
use App\Models\CategoryMovie;

class CategoriesController extends Controller
{
    //

    public function category(){
        return view('categories');
    }

    public function show($slug){
        $category = Categories::where('slug', $slug)->first();
        $movies = CategoryMovie::where('category_id', $category->id)->get();
        $movies = $movies->map(function($movie){
            return Movies::where('id', $movie->movie_id)->first();
        });

        $topViewMovies = $movies->sortByDesc('views')->take(12);


        return view('categories', compact('category', 'movies', 'topViewMovies'));
    }
}
