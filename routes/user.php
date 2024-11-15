<?php


use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'v1',
    'namespace' => 'V1'
], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('forget-password', 'AuthController@forgetPassword');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('register', 'AuthController@register');
    Route::post('memberships', 'MembershipController@store');

    Route::group([
        'middleware' => ['auth:user']
    ], function ($router) {
        Route::post('upload-file', 'MediaController@upload');

        Route::get('page/{slug}', 'PagesController@show');
        Route::apiResource('consultations', 'ConsultationController')->only(['index', 'show']);
        Route::get('categories', 'CategoryController@index');
        Route::apiResource('events', 'EventController')->only(['index', 'show']);
        Route::apiResource('experts', 'ExpertController')->only(['index', 'show']);
        Route::apiResource('studies', 'StudiesController')->only(['index', 'show']);
        Route::apiResource('news', 'NewsController')->only(['index', 'show']);
        Route::post('consultation-request', 'ConsultationRequestController@store');
        Route::post('event-request', 'EventRequestController@store');
    });

});
