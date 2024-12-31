<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actors;
use App\Models\ActorMovie;

class ActorsController extends Controller
{
    //
    function index(){
        $actors = Actors::paginate(10);
        $current_page = $actors->currentPage();
        $total_pages = $actors->lastPage();
        $path = $actors->path();
        return view('admin.pages.actors.index', compact('actors', 'current_page', 'total_pages', 'path'));
    }

    function create(){
        return view('admin.pages.actors.create');
    }

    function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:actors,name|max:255',
            'name_md5' => 'required|unique:actors,name_md5|max:255'
        ]);



        $actor = new Actors();
        $request['name_md5'] = md5($request->name);
        $actor->create($request->all());
        return redirect()->route('admin.actors')->with('success', 'Actor added successfully');
    }

    function edit(string $id){
        $actor = Actors::find($id);
        return view('admin.pages.actors.edit', compact('id', 'actor'));
    }

    function update(Request $request, string $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_md5' => 'required|max:255'
        ]);


        $actor = Actors::find($id);
        $request['name_md5'] = md5($request->name);
        $actor->update($request->all());
        return redirect()->route('admin.actors')->with('success', 'Actor updated successfully');
    }

    function delete(string $id){
        $actor = Actors::find($id);
        $actor->delete();
        return redirect()->route('admin.actors')->with('success', 'Actor deleted successfully');
    }

    function show(string $id){
        $actor_movies = ActorMovie::where('movie_id', $id)->paginate(10);
        $current_page = $actor_movies->currentPage();
        $total_pages = $actor_movies->lastPage();
        $path = $actor_movies->path();
        return view('admin.pages.actors.show', compact('actor_movies', 'id', 'current_page', 'total_pages', 'path'));
    }

    // get add actor to movie
    function addGet(string $id){
        $actor_movies = ActorMovie::where('movie_id', $id)->get();
        $actors = Actors::all()->whereNotIn('id', $actor_movies->pluck('actor_id'));
        return view('admin.pages.actors.add', compact('actor_movies', 'id', 'actors'));
    }

    // add actor to movie
    function addPost(Request $request, string $id){
        $validated = $request->validate([
            'actor_id' => 'required'
        ]);

        $actor_movie = new ActorMovie();
        $actor_movie->actor_id = $request->actor_id;
        $actor_movie->movie_id = $id;
        $actor_movie->timestamps = false;
        $actor_movie->save();
        return redirect()->route('admin.actors.movie_id', $id)->with('success', 'Actor added to movie successfully');
    }

    // delete actor from movie
    function deleteActor(string $id, string $movie_id){
        $actor_movie = ActorMovie::where('actor_id', $id)->where('movie_id', $movie_id);
        $actor_movie->timestamps = false;
        $actor_movie->delete();
        return redirect()->route('admin.actors.movie_id', $movie_id)->with('success', 'Actor deleted from movie successfully');
    }

}
