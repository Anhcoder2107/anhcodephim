<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Categories;
use App\Models\CategoryMovie;
use App\Models\Episodes;

class HomeController extends Controller
{
    //
    public function index(){

        $movies = Movies::all();

        $episodes = Episodes::all();
        $movies = $movies->map(function($movie) use ($episodes){
            $movie->episodes = $episodes->where('movie_id', $movie->id);
            return $movie;
        });
        $movies = $movies->map(function($movie){
            $movie->episodes_count = $movie->episodes->count();
            return $movie;
        });



        $seriesMovies = $movies->where('type', 'series')->take(12);


        $singleMovies = $movies->where('type', 'single')->take(12);


        $trendMovies = $movies->random(12);

        $topViewMovies = $movies->sortByDesc('views')->take(12);

        $sliderMovies = $movies->random(5);




        return view('index', compact('movies', 'seriesMovies', 'singleMovies', 'trendMovies', 'topViewMovies', 'sliderMovies'));
    }






}
