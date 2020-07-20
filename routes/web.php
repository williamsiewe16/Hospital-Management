<?php

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

Route::get('/test', function(){
   return "google";
});

/** get views */
Route::redirect('/','/login');
Route::get('/login','MachineController@getLoginForm')->name("loginForm");
Route::get('/machines','MachineController@getAllMachines')->name("machines");
Route::get('/add-machine','MachineController@displayFormAddMachine')->name("addMachineForm");
Route::get('/update-machine/{id}','MachineController@displayFormUpdateMachine')->name("updateMachineForm")->where('id','[0-9]');

/** post routes */
Route::post('/login','MachineController@login')->name("login");
Route::post('/add-machine','MachineController@addMachine')->name("addMachine");
Route::post('/update-machine','MachineController@updateMachine')->name("updateMachine");
Route::post('/delete-machine','MachineController@deleteMachine')->name("deleteMachine");

/** logout */
Route::get('/logout','MachineController@logout')->name("logout");
