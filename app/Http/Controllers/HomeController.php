<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Categories;
use App\Models\CategoryMovie;
use App\Models\Episodes;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //
    public function index()
    {

        // $movies = Movies::all();

        // $episodes = Episodes::all();
        // $movies = $movies->map(function($movie) use ($episodes){
        //     $movie->episodes = $episodes->where('movie_id', $movie->id);
        //     return $movie;
        // });
        // $movies = $movies->map(function($movie){
        //     $movie->episodes_count = $movie->episodes->count();
        //     return $movie;
        // });



        // $seriesMovies = $movies->where('type', 'series')->take(12);


        // $singleMovies = $movies->where('type', 'single')->take(12);


        // $trendMovies = $movies->random(12);

        // $topViewMovies = $movies->sortByDesc('views')->take(12);

        // $sliderMovies = $movies->random(5);

        $movies = Cache::remember('movies', 60, function () {
            return Movies::with('episodes')->orderBy('view_total', 'desc')->take(20)->get();
        });

        $movies = $movies->map(function ($movie) {
            $movie->episodes_count = $movie->episodes->count();
            return $movie;
        });

        $seriesMovies = $movies->filter(fn($movie) => $movie->type === 'series')->take(12);
        $singleMovies = $movies->filter(fn($movie) => $movie->type === 'single')->take(12);

        $trendMovies = $movies->take(5);
        $topViewMovies = $movies->sortByDesc('view_total')->take(12);
        $sliderMovies = $movies->take(5);

        return view('index', compact('movies', 'seriesMovies', 'singleMovies', 'trendMovies', 'topViewMovies', 'sliderMovies'));



        // return view('index', compact('movies', 'seriesMovies', 'singleMovies', 'trendMovies', 'topViewMovies', 'sliderMovies'));
    }






}
