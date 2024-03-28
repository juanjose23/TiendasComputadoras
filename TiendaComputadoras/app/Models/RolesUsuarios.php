<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUsuarios extends Model
{
    use HasFactory;
    public function roles()
    {
        return $this->belongsToMany('App\Models\RolesModel');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
