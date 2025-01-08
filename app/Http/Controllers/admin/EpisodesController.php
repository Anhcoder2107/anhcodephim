<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episodes;
use App\Models\Movies;

class EpisodesController extends Controller
{


    public function index(){
        $episodes = Episodes::paginate(10);
        $total_pages = $episodes->lastPage();
        $current_page = $episodes->currentPage();
        $path = $episodes->path();
        return view('admin.pages.episodes.index', compact('episodes', 'total_pages', 'current_page', 'path'));
    }

    public function create($id){
        $movie = Movies::find($id);
        return view('admin.pages.episodes.create', compact('id', 'movie'));
    }

    public function store(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'slug' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        $episode = new Episodes();
        $request['movie_id'] = $id;
        $episode->create($request->all());
        return redirect()->route('admin.episodes.movie_id', $id)->with('success', 'Episode added successfully');
    }

    public function edit($id){
        $episode = Episodes::find($id);
        return view('admin.pages.episodes.edit', compact('episode', 'id'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'slug' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        $episode = Episodes::find($id);
        $episode->update($request->all());
        $movie_id = $episode->movie_id;
        return redirect()->route('admin.episodes.movie_id', $movie_id)->with('success', 'Episode updated successfully');
    }


    public function delete($id){
        $episode = Episodes::find($id);
        $episode->delete();
        $movie_id = $episode->movie_id;
        return redirect()->route('admin.episodes.movie_id', $movie_id)->with('success', 'Episode deleted successfully');
    }


    public function episodeByMovie($id){
        $episodes = Episodes::where('movie_id', $id)->orderBy('id', 'desc')->paginate(10);
        $total_pages = $episodes->lastPage();
        $current_page = $episodes->currentPage();
        $path = $episodes->path();
        return view('admin.pages.episodes.show', compact('episodes', 'total_pages', 'current_page', 'path', 'id'));
    }


}
