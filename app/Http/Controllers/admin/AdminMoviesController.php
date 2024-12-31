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
        $total_pages = $movies->lastPage();
        $current_page = $movies->currentPage();
        $path = $movies->path();


        return view('admin.pages.movies.index', compact('movies', 'total_pages', 'current_page', 'path'));
    }

    public function create(){
        return view('admin.pages.movies.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:movies,name|max:1024',
            'slug' => 'required|max:255',
            'origin_name' => 'required|max:1024',
        ]);

        $movie = new Movies();
        $movie->create($request->all());
        return redirect()->route('admin.movies')->with('success', 'Movie added successfully');
    }


    public function edit($id){
        $movie = Movies::find($id);
        return view('admin.pages.movies.edit', compact('movie'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:1024',
            'slug' => 'required|max:255',
            'origin_name' => 'required|max:1024',
        ]);
        $movie = Movies::find($id);
        $movie->update($request->all());
        return redirect()->route('admin.movies')->with('success', 'Movie updated successfully');
    }

    public function delete($id){
        $movie = Movies::find($id);
        $movie->delete();
        return redirect()->route('admin.movies')->with('success', 'Movie deleted successfully');
    }
}
