<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CarDriver;
use App\Car;
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
        return DB::update( ' UPDATE car_assignments SET active = 0  WHERE car_id = '. $car_id  );
    }

    /**
     * Assign data and save it...
     * @param $car_id, $driver_id
     * @return $boolean
     */
    public function assignAndSave( $car_id, $driver_id )
    {
        $this->car_id    = $car_id ;
        $this->driver_id = $driver_id ;
        try
        {
            return $this->save();
        }
        catch( Exception $e )
        {
            return false;
        }
    }
}
