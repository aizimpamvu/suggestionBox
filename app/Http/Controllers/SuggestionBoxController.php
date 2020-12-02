<?php

namespace App\Http\Controllers;


use App\SuggestionPrecedence;
use Illuminate\Http\Request;
use App\Suggestion;
use Illuminate\Support\Facades\DB;
use Session;
use App\User;
use App\AddDepartment;
use App\Unit;
use Gate;
use App\Role;
use Validator;
use Auth;
use Crypt;

class SuggestionBoxController extends Controller
{
    //Index function
    function index()
    {
        return view('home');
    }

    //Suggestion List Function
    function list()
    {
        $data = Suggestion::all();
        $department = AddDepartment::all();
        $assignStaff = DB::table('users')->get();
        $precedence=SuggestionPrecedence::all();
        $unit=Unit::all();

        return view('list', ["data" => $data, "assignStaff" => $assignStaff,"department"=> $department,'unit'=>$unit,'precedence'=>$precedence]);
    }

    //Edit Users
    function updateUsers(Request $request, $id)
    {
//        return $request->all();
        if (Gate::denies('edit-users')) {
            Session::flash('danger', 'You don\'t have a permission to edit a user');
            return back();
        }
        $request->validate([
//            'names' => 'required|max:255',
            'email' => 'required|email|max:40',

        ]);
        $usr = User::find($id);
        $usr->names = $request->input('names');
        $usr->unit_id = $request->unit;
        $usr->email = $request->input('email');
        $usr->roles()->sync($request->roles);
        $usr->save();
        $request->session()->flash('status', $usr->names . ' updated successfully');
        return back();

    }

    //Users Management Function to load role and users on a modal
    function usersManagement(Request $request, User $user)
    {
        $data = User::all();
        $roles = DB::table('roles')->get();
        $unit=DB::table('units')->get();

        return view('usersManagement', ["data" => $data, 'roles' => $roles,'units'=>$unit]);
    }

    //Add a suggestion
    function giveSuggestion(Request $request)
    {
        $request->validate([
            'optradio' => 'required',
            'suggestion' => 'required|max:2000',
        ]);

        $sugg = new Suggestion();
        $sugg->anonymity = $request->input("optradio");
        $sugg->names = $request->input('names');
        $sugg->email = $request->input('email');
        $sugg->telephone = $request->input('telephone');
        $sugg->suggestion_details = $request->input('suggestion');
        $sugg->save();
        $request->session()->flash('status', 'Suggestion submitted successfully');
        return redirect('giveSuggestion');
    }

    //Delete a Function
    function delete($SuggId)
    {
        $delSugg = Suggestion::find($SuggId);
        $delSugg->delete();
        Session::flash('status', 'Suggestion has been deleted Successfully ');

        return redirect('/list');
    }

    function deleteUser($id)
    {
        if (Gate::denies('delete-users')) {
            Session::flash('danger', 'You don\'t have a permission to delete a user');
            return back();
        }
        $delUser = User::find($id);
        $delUser->roles()->detach();
        $delUser->delete();
        Session::flash('status', 'User has been deleted Successfully ');
        return redirect('usersManagement');

    }

    //Code to Edit Suggestion
    function edit($suggId)
    {
        $data = Suggestion::find($suggId);
        return view('editSuggestion', ['data' => $data]);
    }

    function updateSuggestion(Request $request)
    {
        $sugg = Suggestion::find($request->id);
        $sugg->anonymity = $request->input("optradio");
        $sugg->names = $request->input('names');
        $sugg->email = $request->input('email');
        $sugg->telephone = $request->input('telephone');
        $sugg->suggestion_details = $request->input('suggestion');
        $sugg->save();
        $request->session()->flash('status', 'Suggestion updated successfully');
        return redirect('list');
    }
    //Update the users and Roles

    //Login Page
    function login()
    {
        return view('login', 'login');
    }

    function register(Request $request)
    {

        $user = new User();
        $user->names = $request->input('names');
        $user->email = $request->input('email');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->telephone = $request->input('telephone');
        $user->save();
        $request->session()->flash('user', 'User registered successfully');
        $request->session()->put('usr', $request->input('names'));
        return view('register');
    }

    //Display a model
    public function show($suggId)
    {
        $sugg = Suggestion::hereSugg($suggId)->firstOrFail();
        return view('list', compact('sugg'));
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'names' => 'required|min:8|max:50',
            'email' => 'required|email|max:40',

        ]);

        $sugg = new Staff();
        $sugg->names = $request->input("names");
        $sugg->email = $request->input('email');

        $sugg->save();
        $request->session()->flash('status', 'Staff Added successfully');
        return view('addStaff');
    }

    public function assign()
    {
        return view('list');
    }

}
