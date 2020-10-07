<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentUnit extends Model
{
    public function department()
    {
        return $this->belongsTo(addDepartment::class,'department_id');
    }
    public function unitAssign()
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
