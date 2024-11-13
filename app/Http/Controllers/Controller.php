<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Categories;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function __construct(){
        $categories = Categories::all();
        view()->share('categories', $categories);
    }
}
