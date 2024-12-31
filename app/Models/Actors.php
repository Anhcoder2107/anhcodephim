<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actors extends Model
{
    use HasFactory;

    protected $fillable = ['name','name_md5', 'slug'];


    public function movies(){
        return $this->belongsToMany(Movies::class, 'actor_movie', 'actor_id', 'movie_id');
    }

    public function actor_movie(){
        return $this->hasMany(ActorMovie::class);
    }

    protected $hidden = ['created_at', 'updated_at'];
}
