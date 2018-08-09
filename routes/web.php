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
Route::get('threads/create', 'ThreadsController@create')->middleware('must-be-confirmed')->name('threads.create');
Route::get('threads/search', 'SearchController@show');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::patch('threads/{channel}/{thread}', 'ThreadsController@update')->name('threads.update');
Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy')->name('threads.destroy');
Route::post('/threads', 'ThreadsController@store')->middleware('must-be-confirmed');
Route::get('threads/{channel}', 'ThreadsController@index');

Route::group(['middleware' => ['role:moderator|developer']], function () {
    Route::post('locked-threads/{thread}', 'LockedThreadsController@store')->name('locked-threads.store');
    Route::delete('locked-threads/{thread}', 'LockedThreadsController@delete')->name('locked-threads.destroy');

    Route::post('/pinned-threads/{thread}', 'PinnedThreadsController@store')->name('pinned-threads.store');
    Route::delete('/pinned-threads/{thread}', 'PinnedThreadsController@destroy')->name('pinned-threads.destroy');

    Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('best-replies.store');

    Route::post('locked-users/{user}', 'LockedUsersController@store')->name('locked-users.store');
    Route::delete('locked-users/{user}', 'LockedUsersController@destroy')->name('locked-users.destroy');
});

Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy');

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
Route::get('/api/channels', 'Api\ChannelsController@index');

Route::group([
    'prefix' => 'moderator',
    'middleware' => ['role:moderator|developer'],
    'namespace' => 'Moderator'
], function () {
    Route::post('channels', 'ChannelsController@store')->name('moderator.channels.store');
    Route::get('channels/create', 'ChannelsController@create')->name('moderator.channels.create');
    Route::get('channels/{channel}/edit', 'ChannelsController@edit')->name('moderator.channels.edit');
    Route::patch('channels/{channel}', 'ChannelsController@update')->name('moderator.channels.update');
    Route::delete('channels/{channel}', 'ChannelsController@destroy')->name('moderator.channels.destroy');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'role:admin|moderator|developer',
    'namespace' => 'Admin'
], function () {
    Route::get('', 'DashboardController@index')->name('admin.dashboard.index');
    Route::get('channels', 'ChannelsController@index')->name('admin.channels.index');

    Route::get('users', 'UsersController@index')->name('admin.users.index');
    Route::patch('users/edit', 'UsersController@update')->name('admin.users.update');
});

Route::group([
    'prefix' => 'moderator',
    'middleware' => 'role:moderator|developer',
    'namespace' => 'Moderator'
], function () {
    Route::get('', 'DashboardController@index')->name('moderator.dashboard.index');
    Route::get('/channels', 'ChannelsController@index')->name('moderator.channels.index');
    Route::get('users', 'UsersController@index')->name('moderator.users.index');
    Route::get('threads', 'ModeratorThreadsController@index')->name('moderator.threads.index');
});

Route::group([
    'middleware' => 'role:developer',
    'prefix' => 'developer',
    'namespace' => 'developer'
], function () {
    Route::get('', 'DashboardController@index')->name('developer.dashboard.index');
});

