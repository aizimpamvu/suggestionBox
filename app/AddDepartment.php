<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddDepartment extends Model
{
    public function departmentUnits()
    {
        return $this->hasMany(DepartmentUnit::class);
    }
}
