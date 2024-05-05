<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    use HasFactory;
    protected $table = 'sessions';


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
