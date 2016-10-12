<?php

namespace Spot;

use Illuminate\Database\Eloquent\Model;
use Spot\CarDriver;
use Spot\Car;
use DB;

class CarAssignment extends Model
{

    protected $table = 'car_assignments';

    public function cars()
    {
    	return $this->belongsTo( Car::class );
    }

    public function carDrivers()
    {
    	return $this->belongsTo( CarDriver::class );
    }


    /**
     * Method to deactivate others assigments when a new one is going to be created
     * @param $car_id
     * @return $number Number of rows affected 
     */
    public function deactivateOthers( $car_id )
    {
        $assigment = CarAssignment::where( 'car_id', $car_id )
                                    ->first();
        if( isset( $assigment ) ) 
        	return  DB::update( ' UPDATE car_assignments SET active = 0  WHERE car_id = '. $car_id  );
        return false;
    }

    /**
     * My classic way to assign data and save it...
     * @param $car_id, $driver_id
     * @return $boolean
     */
    public function assignAndSave( $car_id, $driver_id )
    {
		$this->car_id    = $car_id ;
		$this->driver_id = $driver_id ;
		return $this->save();
    }
}
