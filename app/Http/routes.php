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
	Route::group(['prefix'=>'api'], function() {
		 
		//Router to create a new article
		//Route::get('/create', 'ArticleController@create');
		 
		//Router to save a new article
		//Route::post('/create', 'ArticleController@store');
		 
		//Router to create a pdf file with the article content
		//Route::get('/{slug}/pdf','ArticleController@pdf');
		 
		//Router to delete an article
		//Route::get('/{id}/destroy','ArticleController@destroy');
		 
		//Router to update an article
		//Route::get('/{id}/update','ArticleController@update');
		 
		//Router to show an article
		//Route::get('/{slug}','ArticleController@index');
		 
	});

});