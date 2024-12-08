<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actors;

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
}
