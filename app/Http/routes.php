<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
	
	//login
	Route::get('/', 'DashboardController@index');
	
	//services without authentication 
	Route::auth();
	
	//Route::get('/dashboard', 'HomeController@index');

	//Router Article
	Route::group(['prefix'=>'articles'], function() {
		
		//Router to delete an article
		Route::delete('/{id}','DashboardController@destroy');
		 
		//Router to update an article
		Route::put('/{id}','DashboardController@update');
		 
		//Router to show an article
		Route::get('/{slug}','DashboardController@index');
		
		//Router to create a new article
		Route::post('/', 'DashboardController@store');
		
		//Router to show an article
		Route::get('/','DashboardController@readAll');
	});

});