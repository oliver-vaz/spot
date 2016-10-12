<?php

namespace Spot;

use Illuminate\Database\Eloquent\Model;
use Spot\CarAssignment;
use Spot\Alarm;
use DB;

class Car extends Model
{

    protected $table = 'cars';

    public function assigments()
    {
    	return $this->hasMany( CarAssignment::class );
    }

    public function alarms()
    {
        return $this->hasMany( Alarm::class );
    }

    public function assignAndSave( $request )
    {
        DB::beginTransaction();
        $this->assign( $request );

    	if( $this->save() )
    	{
    		$assignment   = new CarAssignment();
    		$status       = $assignment->assignAndSave( $this->id, $request['driver-selector'] );

            $status === true ? DB::commit() : DB::rollback();

    		return array( 'status' => $status );
    	}
    	return array( 'status' => false );
    }

    public function update_car( $request )
    {
        $this->assign( $request );
        $this->save();

        $assignment = new CarAssignment();
        $status     = $assignment->deactivateOthers( $this->id );
        
        if( $status !== false )
            $status     = $assignment->assignAndSave( $this->id, $request['u-driver-selector'] );
        return array( 'status' => $status );
    }

    private function assign( $request )
    {
        if( isset( $request['brand'] ) )
        {
            $this->marca            = $request['brand'];
            $this->modelo           = $request['model'];
            $this->placas           = $request['placas'];
            $this->anio             = $request['year-selector'];
            $this->insurance_price  = $request['insurance-price'];
            return;
        }
        $this->marca            = $request['u-brand'];
        $this->modelo           = $request['u-model'];
        $this->placas           = $request['u-placas'];
        $this->anio             = $request['u-year'];
        $this->km               = $request['u-km'];
        $this->insurance_price  = $request['u-insurance-price'];

    }

    public function active( $status )
    {
        $this->active = $status;
        return $this->save();
    }
}
