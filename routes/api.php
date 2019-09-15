<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['auth:api'])->group(function () {
    /*
    *  Participant Routes
    */
    Route::group(['namespace' => 'Participant', 'prefix' => 'participants'], function () {
        Route::get('/{paginate?}', 'ParticipantsController@allParticipants')->name('api.admin.participant.index');
    });
});


//open routes
Route::prefix('')->group(base_path('routes/modules/public.php'));
