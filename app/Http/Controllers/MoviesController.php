<?php

namespace App\Http\Controllers;
use App\Models\Movies;
use App\Models\Categories;
use App\Models\CategoryMovie;
use Illuminate\Http\Request;
use App\Models\Episodes;

class MoviesController extends Controller
{
    //


    public function show($slug){
        $movie = Movies::where('slug', $slug)->first();
        $categories = Categories::all();
        $movie_categories = CategoryMovie::where('movie_id', $movie->id)->get();
        $movie_categories = $movie_categories->map(function($movie_category) use ($categories){
            $category = $categories->where('id', $movie_category->category_id)->first();
            return $category;
        });
        return view('anime-details', compact('movie', 'movie_categories'));
    }

    public function watch($slug, $episode = null){
        if($episode){
            $movie = Movies::where('slug', $slug)->first();
            $episodes = Episodes::where('movie_id', $movie->id)->get()->sortBy('id');
            $episodes = $episodes->where('type', 'embed');
            $episode = $episodes->where('slug', $episode);
            $episode_first = $episode->where('type', 'embed')->first();
            return view('anime-watching', compact('episodes', 'episode_first', 'movie', 'episode'));
        }
        $movie = Movies::where('slug', $slug)->first();
        $episodes = Episodes::where('movie_id', $movie->id)->get()->sortBy('id');
        $episodes = $episodes->where('type', 'embed');
        $episode_first = $episodes->where('type', 'embed')->first();
        return view('anime-watching', compact('movie', 'episodes', 'episode_first'));
    }
}
