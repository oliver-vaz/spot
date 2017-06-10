<?php
Route::get('/', function () {
    return redirect('home');
});
Route::group( [ 'middleware' => 'web' ], function(){
	Route::auth();
	Route::get('/home', 'HomeController@index');
	//	REstFul API
	Route::resource( 'drivers', 'DriverController' );
	Route::resource( 'customers', 'CustomerController' );
	Route::resource( 'cars', 'CarController' );
	Route::resource( 'tasks/', 'TaskController' );
	Route::resource( 'maintenances/', 'MaintenanceController' );
	Route::delete( 'tasks/{id}', 'TaskController@destroys' );
	//Complementary Routes
	Route::delete( 'alarms/{id}', 'CarController@deleteAlarm' );
	Route::post( 'alarms/', 'CarController@saveAlarm' );
	Route::post( 'customers/location', 'CustomerController@save_location' );
	Route::post( 'customers/tariff', 'CustomerController@save_tariff' );
	Route::get( 'customers/{id}/locations', 'CustomerController@getLocations' );
	Route::get( 'customers/{id}/tariffs', 'CustomerController@getTariffs' );
	Route::post( 'drivers/{id}/activate', 'DriverController@activate' );
	Route::post( 'cars/update/{id}', 'CarController@update' );
	Route::get( 'cars/withdata/{id}', 'CarController@showWithData' );
	Route::get( 'maintenances/bycar/{id}', 'MaintenanceController@getMaintenancesByCar' );
});