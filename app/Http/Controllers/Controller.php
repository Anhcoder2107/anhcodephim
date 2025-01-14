<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Categories;
use App\Models\Regions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Carbon;
use App\Models\Movies;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function __construct()
    {
        $categories = Categories::all();
        $regions = Regions::all();
        view()->share('regions', $regions);
        view()->share('categories', $categories);
    }

    public function incrementMovieViews($movieId)
    {
        $movie = Movies::find($movieId);
        $currentDate = Carbon::now();

        // Kiểm tra và reset view_day
        if ($movie->created_at->toDateString() != $currentDate->toDateString()) {
            $movie->view_day = 0;
        }

        // Kiểm tra và reset view_week
        if ($movie->created_at->startOfWeek()->toDateString() != $currentDate->startOfWeek()->toDateString()) {
            $movie->view_week = 0;
        }

        // Kiểm tra và reset view_month
        if ($movie->created_at->startOfMonth()->toDateString() != $currentDate->startOfMonth()->toDateString()) {
            $movie->view_month = 0;
        }

        // Cập nhật các chỉ số
        $movie->view_total += 1;
        $movie->view_day += 1;
        $movie->view_week += 1;
        $movie->view_month += 1;

        // Lưu thay đổi vào cơ sở dữ liệu
        $movie->save();
    }
}
