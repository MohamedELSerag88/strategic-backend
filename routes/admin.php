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
    Route::post('login', 'Auth\LoginController@login');
    Route::post('forget-password', 'Auth\ForgetPasswordController@forgetPassword');
    Route::post('reset-password', 'Auth\ResetPasswordController@resetPassword');

    Route::group([
        'middleware' => ['auth:admin']
    ], function ($router) {
        Route::get('dashboard', 'DashboardController@dashboard');
        Route::get('dropdown/{model}', 'DropDownController@dropDownList');
        Route::post('appConfig-Dropdown', 'DropDownController@appConfigDropDown');
        Route::get('serviceable', 'DropDownController@serviceable');
        Route::post('upload-file', 'MediaController@upload');
        Route::apiResource('roles', 'RoleController');
        Route::apiResource('admins', 'AdminController');
        Route::apiResource('users', 'UserController');
        Route::apiResource('memberships', 'MembershipController');
        Route::apiResource('event-requests', 'EventRequestController');
        Route::apiResource('consultation-requests', 'ConsultationRequestController');
        Route::apiResource('pages', 'PageController');
        Route::apiResource('categories', 'CategoryController');
        Route::apiResource('experts', 'ExpertController');
        Route::apiResource('consultations', 'ConsultationController');
        Route::apiResource('events', 'EventController');
        Route::apiResource('studies', 'StudyController');
        Route::apiResource('opinion_measurements', 'OpinionMeasurementController');
        Route::apiResource('discussion_forums', 'DiscussionForumController');
        Route::apiResource('news', 'NewsController');

    });

});
