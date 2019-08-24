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
    Route::get('register', 'Participants@create')->name('participant.create');
});


Route::get('/logout', 'Login\\LoginController@logout')->name('logout');
