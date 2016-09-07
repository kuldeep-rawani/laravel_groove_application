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

Route::get('/', function () {
    return view('welcome');
});

// These are the Routes for TicketController

Route::group(['prefix' => 'ticket'], function () {

		
 		Route::post('create','TicketController@create');
		Route::get('show/{to}','TicketController@show');
		Route::patch('update','TicketController@update');
		Route::delete('delete','TicketController@delete');

	    Route::post('getstatus/{state}','TicketController@getstatus');
	    Route::patch('updateticketstatus','TicketController@updateticketstatus');
	    Route::post('search','TicketController@search');
		Route::get('master','TicketController@status_master_table');


      });
























//Route::resource('ticket', 'TicketController', ['except' => ['create', 'show','update','delete']]);





// These are the Routes for ReportController

//Route::post('show_yesterday_task','ReportController@show_yesterday_task');
//Route::post('show_last_seven_days_task','ReportController@show_last_seven_days_task');










