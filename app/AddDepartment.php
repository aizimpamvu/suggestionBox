<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddDepartment extends Model
{
    protected $table="add_departments";
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
