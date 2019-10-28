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
        Route::view('/', 'frontend.home.index')->name('frontend.home');

        Route::get('register/{studentStatus?}', 'ParticipantsController@create')->name('participant.create');
        Route::get('register/show/{id}', 'ParticipantsController@show')->name('participant.show');
        Route::view('registration/photograph/rules', 'frontend.rules.photograph')->name('registration.photo.rules');
        Route::get('registration/payment/{uid}', 'ParticipantsController@registrationPayment')->name('registration.payment');
        Route::get('registration/process/payment/{uid}', 'ParticipantsController@registrationPaymentProcess')->name('registration.payment.process');

        Route::get('download/ticket/{uid}', 'ParticipantsController@getDataAfterPayment')->name('ticket.show');
        Route::get('ticket/{uid}/pdf/download', 'ParticipantsController@downloadTicket')->name('ticket.download');


    }
});

Route::group(['namespace' => 'Payment'], function () {
    Route::any('payment/process/{status}', 'PaymentController@status')->name('payment.status');
});


Route::get('/logout', 'Login\\LoginController@logout')->name('logout');
