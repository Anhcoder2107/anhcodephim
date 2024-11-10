<?php

namespace App\Http\Controllers;
use App\Models\Movies;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    //

    public function index(){
        return view('movies.index');
    }

    public function show($slug){
        $movie = Movies::where('slug', $slug)->first();
        return view('anime-details', compact('movie'));
    }

    public function watch($slug){
        $movie = Movies::where('slug', $slug)->first();
        return view('anime-watching', compact('movie'));
    }
}
