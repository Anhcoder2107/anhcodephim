<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regions;
use App\Models\Movies;
use App\Models\RegionMovie;


class RegionsController extends Controller
{
    // show
    public function show($slug){
        $region = Regions::where('slug', $slug)->first();
        $movies = RegionMovie::where('region_id', $region->id)->get();
        $movies = $movies->map(function($movie){
            return Movies::where('id', $movie->movie_id)->first();
        });

        $topViewMovies = $movies->sortByDesc('views')->take(12);

        return view('regions', compact('region', 'movies', 'topViewMovies'));
    }
}
