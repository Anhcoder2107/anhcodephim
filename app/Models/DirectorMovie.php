<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorMovie extends Model
{
    use HasFactory;

    protected $table = 'director_movie';

    protected $fillable = [
        'director_id',
        'movie_id'
    ];

    public function director()
    {
        return $this->belongsTo(Directors::class, 'director_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }

    protected $hidden = ['created_at', 'updated_at'];
}
