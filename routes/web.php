<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::resource('video', 'VideoController');


Route::get('/home', 'HomeController@index')->name('home');

Route::post('/send', 'PostController@sendEmail');

Route::get('/emails', 'PostController@emails');

Route::get('/form', 'PostController@form');

Route::get('/youtube', 'YoutubeChannelController@index');

Route::get('/youtube/create', 'YoutubeChannelController@create');

Route::post('/youtube', 'YoutubeChannelController@store');

Route::delete('/youtube/{youtubeChannel}', 'YoutubeChannelController@destroy');

//Route::get('/youtube/statistics','YoutubeStatisticsController@youtubeInput');

Route::get('/youtube/{youtubeChannel}/statistics','YoutubeStatisticsController@likesDislikesChannelStatistics');

//Route::post('/youtube/statistics','YoutubeStatisticsController@likesDislikesChannelStatistics');

Route::get('/youtube/statistics/top-N','YoutubeStatisticsController@topNChannelsStatistics');

Route::get('/youtube/upload','YoutubeUploadVideoController@index');

Route::get('/youtube/upload/create','YoutubeUploadVideoController@create');

Route::post('/youtube/upload','YoutubeUploadVideoController@uploadVideo');

Route::get('/youtube/upload/{localVideo}/edit','YoutubeUploadVideoController@edit');

Route::patch('/youtube/upload/{localVideo}','YoutubeUploadVideoController@updatingVideo');

Route::delete('/youtube/upload/{localVideo}','YoutubeUploadVideoController@destroy');

