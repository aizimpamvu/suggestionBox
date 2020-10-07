<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Role relationship
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
