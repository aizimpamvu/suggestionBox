<?php

namespace App\Http\Controllers;

use App\AddDepartment;
use App\Unit;
use Session;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    //Display Units

    public function unitsList(){

        $unit = Unit::all();
        $department=AddDepartment::all();

        return view('units', ["units"=> $unit,"departments"=>$department]);
    }
    public function addUnit(Request $request){

        $unit=new Unit();
        $unit->name=$request->input('unitName');
        $unit->department_id=$request->input('departmentName');
        $request->session()->flash('status', 'Unit added successfully');
        $unit->save();
        return back();
    }
    public function deleteUnit($unitId)
    {
        $delUnit = AddDepartment::find($unitId);

        $delUnit ->delete();
        Session::flash('status', 'Unit has been deleted Successfully ');
        return back();
    }

}
