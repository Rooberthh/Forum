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

Route::get('/','ThreadsController@index');

Auth::routes();

Route::view('scan', 'scan');

Route::get('/home', 'HomeController@index');

Route::get('/threads', 'ThreadsController@index')->name('threads');
Route::get('threads/create', 'ThreadsController@create')->middleware('must-be-confirmed');
Route::get('threads/search', 'SearchController@show');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::patch('threads/{channel}/{thread}', 'ThreadsController@update');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::post('threads', 'ThreadsController@store')->middleware('must-be-confirmed');
Route::get('threads/{channel}', 'ThreadsController@index');

Route::post('locked-threads/{thread}', 'LockedThreadsController@store')->name('locked-threads.store')->middleware('must-be-admin');
Route::delete('locked-threads/{thread}', 'LockedThreadsController@delete')->name('locked-threads.destroy')->middleware('must-be-admin');

Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy');

Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('best-replies.store');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');

Route::get('/profiles/{user}/settings/account', 'SettingsController@index')->name('settings.account');
Route::patch('/profiles/{user}/settings/account', 'SettingsController@update')->name('account.update');
Route::get('/profiles/{user}/settings/stats', 'SettingsController@show')->name('settings.stats');

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');

Route::get('/api/users', 'Api\UsersController@index');
Route::post('/api/users/{id}/avatar', 'Api\UserAvatarController@store');

