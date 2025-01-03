<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMovie extends Model
{
    use HasFactory;

    protected $table = 'category_movie';

    protected $fillable = [
        'category_id',
        'movie_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }
}
