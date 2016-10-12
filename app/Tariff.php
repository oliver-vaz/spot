<?php

namespace Spot;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $table	= 'tariffs';

	public function trips()
	{
		return $this->hasMany('Trip');
	}

    /**
     * Assign and Save a tariff.
     *
     * @param  Request  $request, Customer $customer
     * @return boolean
     */
	public function assignAndSave( $request, $customer )
	{
		$date 					= explode( '/',$request['init-date'] );
		$this->active 			= $request[ 'tarrif-checkbox' ] === 'on' ? 1 : 0 ;
		$this->init_date 		= $date[2] . '-' . $date[1] . '-' . $date[0];
		$this->price_per_car	= $request['car-price'];
		$this->price_per_person	= $request['person-price'];

		$this->customername		= $customer->short_name ;
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
