<?php
/**
 * Created by PhpStorm.
 * User: kapilpaul
 * Date: 22/8/19
 * Time: 11:32 PM
 */

/*
 * Namespace: Participants
 */
Route::group(['namespace' => 'Participant'], function () {
    if (request()->is('api/*')) {
        Route::post('register/store', 'ParticipantsController@store')->name('api.participant.store');
    } else {
        Route::get('register/{studentStatus}', 'ParticipantsController@create')->name('participant.create');
    }
});


Route::get('/logout', 'Login\\LoginController@logout')->name('logout');
