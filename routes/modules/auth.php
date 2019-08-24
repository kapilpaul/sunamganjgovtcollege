<?php
/**
 * Created by PhpStorm.
 * User: kapilpaul
 * Date: 22/8/19
 * Time: 11:30 PM
 */

/*
 * Namespace : Login
 */
Route::group(['namespace' => 'Login'], function () {
    /*
     * Login Routes
     */
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'LoginController@login')->name('login');
        Route::post('/', 'LoginController@postLogin')->name('postLogin');
    });

    /*
     * Activation by email Routes
     */
    Route::group(['prefix' => 'activation'], function () {
        Route::get('/{email}/{activationcode}', 'ActivationController@activateUser');
    });

    /*
     * Forgot Password Routes
     */
    Route::group(['prefix' => 'forgotpassword'], function () {
        Route::get('/', 'ForgetPasswordController@forgotPasword')->name('forgotpassword');
        Route::post('/', 'ForgetPasswordController@postForgotPassword')->name('postForgotpassword');
    });

    /*
     * Reset Routes
     */
    Route::group(['prefix' => 'reset'], function () {
        Route::get('/{email}/{code}', 'ForgetPasswordController@resetPassword')->name('resetPassword');
        Route::post('/{email}/{code}', 'ForgetPasswordController@postResetPassword')->name('postResetPassword');
    });
});
/* -- End of Namespace : Login group -- */
