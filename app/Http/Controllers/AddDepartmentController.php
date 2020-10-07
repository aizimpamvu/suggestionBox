<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\User;
use Gate;
use App\Role;
use Validator;
use Auth;
use Crypt;
use App\AddDepartment;

class AddDepartmentController extends Controller
{
    public function addDepartment(Request $request){

        $department=new AddDepartment();
//        $dpart = Suggestion::all();
        $department->department_name=
            $request->input('departmentName');
        $request->session()->flash('status', 'Department added successfully');
        $department->save();

    return back();
    }
    public function departmentList()
    {

        $department = AddDepartment::all();
//        return view('list', ["department"=> $department]);
        return view('addDepartment', ["department"=> $department]);
    }
    public function deleteDepartment($departmentId)
    {
        $delDepartment = AddDepartment::find($departmentId);
//        $delUser->roles()->detach();
        $delDepartment ->delete();
        Session::flash('status', 'Department has been deleted Successfully ');
        return back();
    }
}
