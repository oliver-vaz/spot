<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table	= 'locations';

    public function trips()
	{
		return $this->hasMany('Trip');
	}

	public function assignAndSave( $request, $customer )
	{
		$this->name 			= $request['location-name'];
		$this->description 		= $request['location-address'];
		$this->customer_name	= $customer->short_name ;
		$this->customer_id		= $customer->id ;
		try
		{
			if( $this->save() )
				return true;
		} catch( Exception $e ) {
			return false;
		}
		return false;
	}

}
