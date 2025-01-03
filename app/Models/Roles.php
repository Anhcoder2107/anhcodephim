<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class Roles extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
