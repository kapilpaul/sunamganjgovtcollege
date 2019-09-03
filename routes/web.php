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


Route::middleware(['installer', 'visitors'])->group(function () {
    Route::prefix('')->group(base_path('routes/modules/auth.php'));
});



Route::middleware(['installer', 'authcheck'])->group(function () {
    /*
    *  Routes
    */
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('home', 'DashboardController@index')->name('admin.home');
    });

    /*
    *  Participant Routes
    */
    Route::group(['namespace' => 'Participant', 'prefix' => 'participants'], function () {
        Route::post('/filter', 'ParticipantsController@filter')->name('participant.filter');
        Route::get('/{student_status?}', 'ParticipantsController@index')->name('participant.index');
    });
});


//open routes
Route::prefix('')->group(base_path('routes/modules/public.php'));
