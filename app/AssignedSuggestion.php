<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedSuggestion extends Model
{
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_user');
    }

    public function suggestion()
    {
        return $this->belongsTo(Suggestion::class, 'suggestion_id');
    }
}
