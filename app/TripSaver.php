<?php namespace App;

use App\Tariff;
use App\Customer;
use App\Trip;
use App\Location;

class TripSaver
{
	private $array_to_save 	= [];
	public $errors 			= [];

    /**
     * To save a tariff.
     * @param  Request  $request, Customer $customer
     * @return boolean
     */
	public function save( $request, Customer $customer, Trip $trip )
	{
		if( !$this->validateIds( $request ) )
			return [ 'status' => false,  'message' => $this->errors ];
		if( $this->getComplementaryData( $request, $customer ) &&
			$trip->assignAndSave( $this->array_to_save ) ){

			return [ 'status' => true,  'data' => $trip ];
		}
		return [ 'status' => false,  'message' => $this->errors ];
	}

	/**
	 * Method to validate if location & driver exists in the system
	 * @param Array $request
	 * @return Boolean  
	 */
	private function validateIds( $request )
	{
		$location 	= Location::find( $request['location_id'] );
		$driver		= CarDriver::find( $request['driver_id'] );
		if( isset($location->id) && isset($driver->id) )
		{
			$this->array_to_save['location_id'] = $location->id;
			$this->array_to_save['driver_id'] = $driver->id;
			return true;
		}
		$this->errors[] = 'El conductor o la sucursal no son válidos';
		return false;
	}

	/**
	 * Method to get Additional data to create a tariff record
	 * @param Array $request
	 * @param Customer $customer
	 * @return Boolean
	 */
	private function getComplementaryData( $request, Customer $customer )
	{
		$tariff = Tariff::where('active', 1)
						->where('customer_id', $customer->id )
						->first();
		if( isset($tariff->id) )
		{
			$this->array_to_save['tariff_id'] 	=  $tariff->id;
			$this->array_to_save['customer_id'] =  $customer->id;
			$this->array_to_save['date'] 		=  $request['date'];
			return true;
		}
		$this->errors[] = 'No hay una tarifa activa para el cliente';
		return false;
	}
}