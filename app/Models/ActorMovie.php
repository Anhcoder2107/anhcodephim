<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorMovie extends Model
{
    use HasFactory;

    protected $table = 'actor_movie';

    protected $fillable = ['actor_id', 'movie_id'];

    public function actor()
    {
        return $this->belongsTo(Actors::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movies::class);
    }

    protected $hidden = ['created_at', 'updated_at'];


}
