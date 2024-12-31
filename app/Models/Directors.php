<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directors extends Model
{
    use HasFactory;

    protected $fillable = ['name','name_md5', 'slug'];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'director_movie', 'director_id', 'movie_id');
    }

    public function directorMovie()
    {
        return $this->hasMany(DirectorMovie::class, 'director_id');
    }


}
