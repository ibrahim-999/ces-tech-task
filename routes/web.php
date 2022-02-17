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

use App\Http\Controllers\CompanyController;
use App\Mail\WelcomeMail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/companies', 'CompanyController');

Route::resource('/employees', 'EmployeeController');
Route::get('/employees/{id}/create', 'EmployeeController@add');

Route::get('/company',[CompanyController::class,'index']);

Route::get('/email', function() {
    Mail::to('ibrahimkhalaf99@gmail.com')->send(new WelcomeMail());
    return new WelcomeMail();
}) ;
