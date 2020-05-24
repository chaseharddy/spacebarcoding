<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Session Update */
Route::middleware('auth')->get('/admin', "Auth\ApiTokenController@update");

/* Public Home */
Route::get('/', function(){
    return view('home');
});

/* Disable default regiserter auth */
Auth::routes(['register' => false]);
