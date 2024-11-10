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
}
