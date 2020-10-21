<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuggestionPrecedence;
use Session;

class SuggestionPrecedenceController extends Controller
{
    public function suggestionPrecedenceList()
    {

        $precedence = SuggestionPrecedence::all();
        return view('suggestionPrecedence', ["precedence"=> $precedence]);
    }
    function addPrecedence(Request $request){

        $precedence=new SuggestionPrecedence();
        $precedence->precedence=$request->input('precedenceName');
        $request->session()->flash('status', 'Precedence  added successfully');
        $precedence->save();
        return back();
    }

}
