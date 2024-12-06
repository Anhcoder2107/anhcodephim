<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episodes;
use App\Models\Movies;

class EpisodesController extends Controller
{
    //

    public function index(){
        $episodes = Episodes::paginate(10);

        $total_pages = $episodes->lastPage();
        $current_page = $episodes->currentPage();
        $path = $episodes->path();
        return view('admin.pages.episodes.index', compact('episodes', 'total_pages', 'current_page', 'path'));
    }

    public function create($id){
        return view('admin.pages.episodes.create', compact('id'));
    }

    public function store(Request $request){
        $episode = new Episodes();
        $episode->create($request->all());
        return redirect()->route('admin.episodes')->with('success', 'Episode added successfully');
    }

    public function edit($id){
        $episode = Episodes::find($id);
        return view('admin.pages.episodes.edit', compact('episode'));
    }

    public function update(Request $request, $id){
        $episode = Episodes::find($id);
        $episode->update($request->all());
        return redirect()->route('admin.episodes')->with('success', 'Episode updated successfully');
    }


    public function delete($id){
        $episode = Episodes::find($id);
        $episode->delete();
        return redirect()->route('admin.episodes')->with('success', 'Episode deleted successfully');
    }


    public function episodeByMovie($id){
        $episodes = Episodes::where('movie_id', $id)->paginate(10);
        $total_pages = $episodes->lastPage();
        $current_page = $episodes->currentPage();
        $path = $episodes->path();
        return view('admin.pages.episodes.index', compact('episodes', 'total_pages', 'current_page', 'path'));
    }


}
