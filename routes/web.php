<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('/',function(){
    return redirect('home');
});
Route::get('/home','AuthController@index')->name('home');
Route::get('/logout' , 'AuthController@logout')->name('logout');


Route::post('/scan','TruckController@insertDeliverLogs');





