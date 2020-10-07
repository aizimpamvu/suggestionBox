<?php

namespace App\Http\Controllers;

use App\AssignedSuggestion;
use App\Suggestion;
use App\User;
use Illuminate\Http\Request;

class AssignedSuggestionController extends Controller
{
    public function store(Request $request,Suggestion  $suggestion)
    {
        $model = new AssignedSuggestion();
        $model->assigned_user = $request->input('assigned_user');
        $model->suggestion_id = $suggestion->id;
        $model->comment = $request->input('comment');

        $model->save();
        return back();
    }

    public function assignedTo(User  $user)
    {
        $list=AssignedSuggestion::with('suggestion')->where('assigned_user','=',$user->id)->get();
        return view('assigned_to',compact('list'));
    }
    //View Suggestion details
    function list()
    {

        $assignStaff = DB::table('users')->get();

        return view('list', ['assignStaff' => $assignStaff]);
    }
}
