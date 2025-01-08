<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movies;
use App\Models\Categories;
use App\Models\Episodes;
use App\Models\Actors;
use App\Models\Directors;
use App\Models\Regions;

class HomeController extends Controller
{
    //

    public function index()
    {
        $categories = Categories::inRandomOrder()->limit(5)->get();
        $episodes = Episodes::inRandomOrder()->limit(5)->get();
        $actors = Actors::inRandomOrder()->limit(5)->get();
        $directors = Directors::inRandomOrder()->limit(5)->get();
        $regions = Regions::inRandomOrder()->limit(5)->get();
        $movies = Movies::inRandomOrder()->limit(10)->get();

        $movieCount = Movies::count();
        $episodeCount = Episodes::count();
        $actorCount = Actors::count();
        $directorCount = Directors::count();
        return view('admin.index', compact('movies', 'categories', 'episodes', 'actors', 'directors', 'regions', 'movieCount', 'episodeCount', 'actorCount', 'directorCount'));
    }
}
