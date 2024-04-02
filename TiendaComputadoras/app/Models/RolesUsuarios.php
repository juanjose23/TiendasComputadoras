<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUsuarios extends Model
{
    use HasFactory;
    protected $table = "rolesusuarios";
    public function rolesmodel()
    {
        return $this->belongsTo(RolesModel::class, 'roles_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\Models\User');
    }

    
}
