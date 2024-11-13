<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    //

    public function category(){
        return view('categories');
    }

    public function show($slug){
        $category = Categories::where('slug', $slug)->first();
        return view('categories', compact('category'));
    }
}
