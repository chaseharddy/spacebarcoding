<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Register */
Route::middleware('auth:api')->post('/registeruser', 'Auth\RegisterController@registeruser');
Route::middleware('auth:api')->post('/registerstudent', 'Auth\RegisterController@registerstudent');
/* FTP Accounts
    user params 'name' and 'pass'
*/

/* Data */
    //staff
Route::middleware('auth:api')->get('/staff', "StaffController@getStaff");
Route::middleware('auth:api')->post('/staff', "StaffController@addStaff");
Route::middleware('auth:api')->delete('/staff', "StaffController@removeStaff");
    //student
Route::middleware('auth:api')->get('/student', "StudentController@getStudent");
Route::post('/student', "StudentController@addStudent");
Route::delete('/student', "StudentController@removeStudent");
    //transfer
Route::middleware('auth:api')->post('/migrate', "TransferController@migrateStudentsToPublic");
    //computer
Route::middleware('auth:api')->get('/computer', "ComputerController@getComputers");  
Route::post('/computer', "ComputerController@checkComputer");  
Route::middleware('auth:api')->delete('/computer', "ComputerController@removeComputer");  
    // student to computer
Route::middleware('auth:api')->get('/studenttocomputer', "ComputerController@getStudentComputer");   
Route::middleware('auth:api')->post('/studenttocomputer', "ComputerController@addStudentToComputer");  
Route::middleware('auth:api')->delete('/studenttocomputer', "ComputerController@removeStudentFromComputer");  