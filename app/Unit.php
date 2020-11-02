<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table="units";
    public function department()
    {
        return $this->belongsTo(AddDepartment::class);
    }
}
