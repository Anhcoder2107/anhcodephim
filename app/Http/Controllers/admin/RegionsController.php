<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regions;
use App\Models\RegionMovie;

class RegionsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $regions = Regions::paginate(10);
        // $current_page = $regions->currentPage();
        // $total_pages = $regions->lastPage();
        // $path = $regions->path();
        // return view('admin.pages.regions.index', compact('regions', 'current_page', 'total_pages', 'path'));

        $regions = Regions::when(request('search'), function($query){
            return $query->where('name', 'like', '%'.request('search').'%');
        })->paginate(10);

        $total_pages = $regions->lastPage();
        $current_page = $regions->currentPage();
        $path = $regions->path();

        return view('admin.pages.regions.index', compact('regions', 'total_pages', 'current_page', 'path'));

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
        $validated = $request->validate([
            'name' => 'required|unique:regions,name|max:255',
            'slug' => 'required|max:255'
        ]);


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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);

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

    //show regionmovie
    public function show(string $id)
    {
        $region = Regions::find($id);
        $region_movies = RegionMovie::where('movie_id', $id)->paginate(10);
        $total_pages = $region_movies->lastPage();
        $current_page = $region_movies->currentPage();
        $path = $region_movies->path();
        return view('admin.pages.regions.show', compact('region_movies', 'region', 'id', 'total_pages', 'current_page', 'path'));
    }

    //add regionmovie
    public function addGet(string $id)
    {
        $region_movie = RegionMovie::where('movie_id', $id)->get();
        $regions = Regions::all()->whereNotIn('id', $region_movie->pluck('region_id'));
        return view('admin.pages.regions.add', compact('regions', 'id'));
    }

    public function addPost(Request $request, string $id)
    {
        $validated = $request->validate([
            'region_id' => 'required'
        ]);

        $validated = request()->safe()->only('region_id');

        $region_movie = new RegionMovie();
        $region_movie->region_id = $request->region_id;
        $region_movie->movie_id = $id;
        $region_movie->timestamps = false;
        $region_movie->save();
        return redirect()->route('admin.regions.movie_id', $id);
    }

    //delete regionmovie
    public function deleteRegion(string $id, string $movie_id)
    {
        $region_movie = RegionMovie::where('region_id', $id)->where('movie_id', $movie_id);
        $region_movie->delete();
        return redirect()->route('admin.regions.movie_id', $id);
    }
}
