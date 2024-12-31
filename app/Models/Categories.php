<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'category_movie', 'category_id', 'movie_id');
    }


}
