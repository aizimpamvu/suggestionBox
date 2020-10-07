<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function AssignedUnits()
    {
        return $this->hasOne(DepartmentUnit::class);
    }
}
