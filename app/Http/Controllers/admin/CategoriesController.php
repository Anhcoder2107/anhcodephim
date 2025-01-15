<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\CategoryMovie;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Categories::paginate(10);
        // $current_page = $categories->currentPage();
        // $total_pages = $categories->lastPage();
        // $path = $categories->path();
        // return view('admin.pages.categories.index', compact('categories', 'current_page', 'total_pages', 'path'));

        $categories = Categories::when(request('search'), function($query){
            return $query->where('name', 'like', '%'.request('search').'%');
        })->paginate(10);

        $total_pages = $categories->lastPage();
        $current_page = $categories->currentPage();
        $path = $categories->path();

        return view('admin.pages.categories.index', compact('categories', 'total_pages', 'current_page', 'path'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'slug' => 'required|max:255'
        ]);

        $category = new Categories();
        $category->create($request->all());
        return redirect()->route('admin.categories')->with('success', 'Category added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categories::find($id);
        return view('admin.pages.categories.edit', compact('category', 'id'));
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


        $category = Categories::find($id);
        $category->update($request->all());
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }

    // show CategoryMovie
    public function show(string $id){
        $category = Categories::find($id);
        $category_movie = CategoryMovie::where('movie_id', $id)->paginate(10);
        $current_page = $category_movie->currentPage();
        $total_pages = $category_movie->lastPage();
        $path = $category_movie->path();
        return view('admin.pages.categories.show', compact('category', 'category_movie', 'current_page', 'total_pages', 'path', 'id'));
    }

    // add CategoryMovie
    public function addGet(string $id){
        $category_movie = CategoryMovie::where('movie_id', $id)->get();
        $category = Categories::all()->whereNotIn('id', $category_movie->pluck('category_id'));
        return view('admin.pages.categories.add', compact('category', 'id'));
    }

    public function addPost(Request $request, string $id){
        $validated = $request->validate([
            'category_id' => 'required'
        ]);

        $category_movie = new CategoryMovie();
        $category_movie->category_id = $request->category_id;
        $category_movie->movie_id = $id;
        $category_movie->timestamps = false;
        $category_movie->save();
        return redirect()->route('admin.categories.movie_id', $id)->with('success', 'Category added successfully');
    }

    public function deleteCategory(string $id, string $movie_id){
        $category_movie = CategoryMovie::where('category_id', $id)->where('movie_id', $movie_id);
        $category_movie->delete();
        return redirect()->route('admin.categories.movie_id', $movie_id)->with('success', 'Category deleted successfully');
    }

}
