<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $withCount = ['assignedSuggestion'];

    public function assignedSuggestion()
    {
        return $this->hasOne(AssignedSuggestion::class);
    }
}
