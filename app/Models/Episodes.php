<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'server',
        'name',
        'slug',
        'type',
        'link',
    ];

    public function movie(){
        return $this->belongsTo(Movies::class);
    }
}
