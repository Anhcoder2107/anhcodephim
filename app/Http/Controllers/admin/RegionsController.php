<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regions;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Regions::paginate(10);
        $current_page = $regions->currentPage();
        $total_pages = $regions->lastPage();
        $path = $regions->path();
        return view('admin.pages.regions.index', compact('regions', 'current_page', 'total_pages', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $region = new Regions();
        $region->create($request->all());
        return redirect()->route('admin.regions');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $region = Regions::find($id);
        return view('admin.pages.regions.edit', compact('region', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $region = Regions::find($id);
        $region->update($request->all());
        return redirect()->route('admin.regions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $region = Regions::find($id);
        $region->delete();
        return redirect()->route('admin.regions');
    }
}
