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

Route::get('/', function () {
	$id = 'welcome';
    return view('welcome', compact('id'));
});

Route::middleware(['auth'])->group(function() {
	Route::post('/quiz_demo', 'PagesController@quiz');
	Route::post('/question', 'PagesController@question');
	Route::post('/updateImg', 'PagesController@updateImg');
	Route::post('/update', 'PagesController@updateProfile');
	Route::post('/updatePassword', 'PagesController@updatePassword');
	Route::post('/updateSend', 'PagesController@updateSend');
	Route::post('/sendBitcoin', 'PagesController@sendBitcoin');
	Route::get('/received', 'PagesController@received');
	Route::get('/quiz', 'PagesController@quiz_demo');
	Route::get('/pending', 'PagesController@pending');
	Route::get('/checkAnswer', 'PagesController@checkAnswer');
	Route::get('/noAnswer', 'PagesController@noAnswer');
	Route::get('/profile', 'PagesController@profile');
	Route::get('/editProfile', 'PagesController@editProfile');
	Route::get('/changePassword', 'PagesController@changePassword');
	Route::get('/credit', 'PagesController@credit');
	Route::get('/debit', 'PagesController@debit');
	Route::get('/transaction_history', 'PagesController@transaction_history');
	Route::get('/notification', 'PagesController@notification');
	Route::get('/previous_quiz', 'PagesController@previous_quiz');
	Route::get('/pay', 'PagesController@pay');
	Route::get('/category', 'PagesController@category');
	Route::get('/home', 'HomeController@index')->name('home');
});
Route::post('/contact', 'PagesController@contact');

Route::get('/demo', 'PagesController@demo');

Auth::routes();


