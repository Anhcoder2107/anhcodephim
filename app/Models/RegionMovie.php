<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionMovie extends Model
{
    use HasFactory;

    protected $table = 'movie_region';

    protected $fillable = ['movie_id', 'region_id'];

    public function movie(){
        return $this->belongsTo(Movies::class, 'movie_id');
    }

    public function region(){
        return $this->belongsTo(Regions::class, 'region_id');
    }
}
