<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        //
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
        //
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
}
