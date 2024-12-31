<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function movies(){
        return $this->belongsToMany(Movies::class, 'region_movie', 'region_id', 'movie_id');
    }

}
