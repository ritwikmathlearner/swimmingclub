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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/children', 'HomeController@childrenView')->name('view.children');
Route::get('/children/create', 'HomeController@childrenCreate')->name('create.children');
Route::post('/children/store', 'HomeController@childrenStore')->name('store.children');
Route::get('/profile/edit', 'HomeController@editProfile')->name('edit.profile');
Route::post('/profile/update', 'HomeController@updateProfile')->name('update.profile');
Route::get('/squad', 'HomeController@squad')->name('view.squad');
Route::get('/training/add', 'HomeController@addTraining')->name('add.training');
Route::post('/training/store', 'HomeController@storeTraining')->name('store.training');
Route::get('/raceresult/add', 'HomeController@addRaceResult')->name('add.raceresult');
Route::post('/raceresult/store', 'HomeController@storeRaceResult')->name('store.raceresult');
