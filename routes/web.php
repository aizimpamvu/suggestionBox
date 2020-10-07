<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'SuggestionBoxController@index');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::middleware('can:manage-users')->group(function () {
        Route::get('/list', 'SuggestionBoxController@list');
            Route::middleware('can:edit-users')->group(function () {
                 Route::get('delete/{id}', 'SuggestionBoxController@delete');
                 Route::get('deleteUser/{id}', 'SuggestionBoxController@deleteUser');
                 Route::get('editSuggestion/{id}', 'SuggestionBoxController@edit');
                Route::post('/users/{id}/update', 'SuggestionBoxController@updateUsers')->name('users.update');
                //Department Routes
                Route::view('addDepartment','addDepartment');
                Route::get('addDepartment','AddDepartmentController@departmentList');
                Route::post('addDepartment','AddDepartmentController@addDepartment')->name('add.department');
                Route::get('deleteDepartment/{departmentId}', 'AddDepartmentController@deleteDepartment');
        });
        Route::get('/usersManagement', 'SuggestionBoxController@usersManagement');

    });

    Route::post('editSuggestion/{id}', 'SuggestionBoxController@updateSuggestion');
    Route::post('/suggestion/{suggestion}/assign', 'AssignedSuggestionController@store')->name('suggestion.assign');
    Route::get('/suggestion/assigned/{user}/user', 'AssignedSuggestionController@assignedTo')->name('suggestion.assignedToMe');
    //Add Unit
    Route::view('units','unit');
    Route::get('units','UnitController@unitsList');
    Route::post('units','UnitController@addUnit')->name('add.unit');
    Route::get('deleteUnit/{unitId}', 'UnitController@deleteUnit');
});



Route::view('giveSuggestion', 'giveSuggestion');
Route::POST('giveSuggestion', 'SuggestionBoxController@giveSuggestion');


//Route::namespace('Admin')->name('admin')->middleware('can:manage-users')->group(function(){
//    Route::resource('/usersManagement','SuggestionBoxController',['except'=>['show','create','store']]);
//});




Route::get('/home', 'HomeController@index')->name('home');

