<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'origin_name',
        'slug',
        'content',
        'thumb_url',
        'poster_url',
        'type',
        'status',
        'trailer_url',
        'episode_time',
        'episode_current',
        'episode_total',
        'quality',
        'language',
        'publish_year',
    ];

    //foeign key with category_movie
    public function categories(){
        return $this->belongsToMany(Categories::class, 'category_movie', 'movie_id', 'category_id');
    }

    //foreign key with episodes
    public function episodes(){
        return $this->hasMany(Episodes::class);
    }

    //foreign key with actor_movie
    public function actors(){
        return $this->belongsToMany(Actors::class, 'actor_movie', 'movie_id', 'actor_id');
    }

    //foreign key with director_movie
    public function directors(){
        return $this->belongsToMany(Directors::class, 'director_movie', 'movie_id', 'director_id');
    }

    //foreign key with region_movie
    public function regions(){
        return $this->belongsToMany(Regions::class, 'region_movie', 'movie_id', 'region_id');
    }
}
