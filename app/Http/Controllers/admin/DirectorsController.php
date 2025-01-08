<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DirectorMovie;
use Illuminate\Http\Request;
use App\Models\Directors;

class DirectorsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directors = Directors::paginate(10);
        $current_page = $directors->currentPage();
        $total_pages = $directors->lastPage();
        $path = $directors->path();
        return view('admin.pages.directors.index', compact('directors', 'current_page', 'total_pages', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.directors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:directors,name|max:255',
            'name_md5' => 'required|unique:directors,name_md5|max:255'
        ]);


        $director = new Directors();
        $request['name_md5'] = md5($request->name);
        $director->create($request->all());
        return redirect()->route('admin.directors')->with('success', 'Director added successfully');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $director = Directors::find($id);
        return view('admin.pages.directors.edit', compact('director', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_md5' => 'required|max:255'
        ]);

        $director = Directors::find($id);
        $request['name_md5'] = md5($request->name);
        $director->update($request->all());
        return redirect()->route('admin.directors')->with('success', 'Director updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        $director = Directors::find($id);
        $director->delete();
        return redirect()->route('admin.directors')->with('success', 'Director deleted successfully');
    }

    public function directorByMovie(string $id)
    {
        $directorMovies = DirectorMovie::where('movie_id', $id)->paginate(10);
        $movie_id = $id;
        $current_page = $directorMovies->currentPage();
        $total_pages = $directorMovies->lastPage();
        $path = $directorMovies->path();
        return view('admin.pages.directors.show', compact('directorMovies', 'current_page', 'total_pages', 'path', 'movie_id'));
    }

    public function addGet(string $id)
    {
        $movie_id = $id;
        $directors = Directors::all();
        $directorMovies = DirectorMovie::where('movie_id', $id)->paginate(10);
        $directors = Directors::all()->whereNotIn('id', $directorMovies->pluck('director_id'));

        return view('admin.pages.directors.add', compact('movie_id', 'directorMovies', 'directors'));
    }

    public function addPost(Request $request, string $id)
    {
        $validated = $request->validate([
            'director_id' => 'required'
        ]);

        $directorMovie = new DirectorMovie();
        $request['movie_id'] = $id;
        $directorMovie->director_id = $request->director_id;
        $directorMovie->movie_id = $request->movie_id;
        $directorMovie->timestamps = false;
        $directorMovie->save();
        return redirect()->route('admin.directors.movie_id', $id)->with('success', 'Director added successfully');
    }

    public function deleteDirector(string $id, string $movie_id)
    {
        $directorMovie = DirectorMovie::where('director_id', $id)->where('movie_id', $movie_id);
        $directorMovie->delete();
        return redirect()->route('admin.directors.movie_id', $movie_id)->with('success', 'Director deleted successfully');
    }
}
