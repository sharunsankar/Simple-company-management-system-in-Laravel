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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route; 

Route::group(['middleware'=>'auth'],function ()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resources([
        'companies' => 'CompanyController',
        'employees' => 'EmployeeController'
    ]);

    Route::post('/import', 'HomeController@import')->name('file.import');

});     

Auth::routes(['register' => false]);


