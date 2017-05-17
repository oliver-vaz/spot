<?php

use App\ExcelGenerator;

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
	Route::post( 'cars/update/{id}', 'CarController@update' );
	Route::get( 'cars/withdata/{id}', 'CarController@showWithData' );
	Route::get( 'maintenances/bycar/{id}', 'MaintenanceController@getMaintenancesByCar' );

});

Route::get( 'test', function(){

	$o1 = new StdClass();
	$o1->x = 1;
	$o1->y = 24;

	$o2 = new StdClass();
	$o2->x = 2;
	$o2->y = 25;

	$data = [ 
		$o1, $o2 
		];
	$headers = [ 'X', 'Y' ];

	$e = new ExcelGenerator();
	$e->create( 'myXls', $data, $headers, [ 'x', 'y' ] );

});

