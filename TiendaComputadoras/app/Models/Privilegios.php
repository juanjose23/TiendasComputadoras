<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilegios extends Model
{
    protected $table = 'roles';
    use HasFactory;

    public function roles()
    {
        return $this->belongsTo('App\Models\RolesModel');
    }

    public function submodulos()
    {
        return $this->belongsTo('App\Model\submodulos');
    }
}
