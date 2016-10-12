<?php


Route::get('/login', function () {
    return view('login');
});



//Route::resource( 'drivers', 'DriverController' );

Route::group( [ 'middleware' => 'web' ], function(){
	Route::auth();
	Route::get('/home', 'HomeController@index');

	//	REstFul API
	Route::resource( 'drivers', 'DriverController' );
	Route::resource( 'customers', 'CustomerController' );
	Route::resource( 'cars', 'CarController' );
	Route::resource( 'tasks/', 'TaskController' );

	//Complementary Routes
	Route::post( 'alarms/', 'CarController@saveAlarm' );
	Route::post( 'customers/location', 'CustomerController@save_location' );
	Route::post( 'customers/tariff', 'CustomerController@save_tariff' );
	Route::post( 'cars/update/{id}', 'CarController@update' );
	Route::get( 'cars/withdata/{id}', 'CarController@showWithData' );

});

