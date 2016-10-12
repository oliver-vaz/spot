<?php

namespace Spot;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table 	= 'customers';

	public function tariffs()
	{
		return $this->hasMany('Tariff');
	}

	public function locations()
	{
		return $this->hasMany('Location');
	}


    /**
     * Assing data and Store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean $response
     */
	public function assignAndSave( $request )
	{
		$valid = $this->validate($request);
		if( !$valid['status'] )
		{
			return $valid;
		}
        $this->name 		= $request['name'];
        $this->short_name 	= $request['shortname'];
        $this->rfc 			= $request['rfc'];
        $this->phone		= $request['phone'];
        $this->cellphone 	= $request['cellphone'];
        $this->alter_phone 	= $request['alterphone'];
        $this->zipcode 		= $request['zipcode'];
        $this->address 		= $request['address'];
        $this->city 		= $request['city'];
        $this->active 		= true;
        try{
	        if( $this->save() )
	        	return [ 'status' => true ];

        }catch( Exception $e ){
	        return [ 'status' => false, 'errors' => $e->getTrace() ];
        }
        return [ 'status' => false ];
	}

	private function validate( Array $request )
	{
		$validator = Validator::make( $request, [
                'name' => 'required|string',
                'shortname' => 'required|string'
        ]);

		if( $validator->fails() )
		{
			return [ 'status' => false, 'errors' => $validator ];
		}
		return [ 'status' => true ];
	}

	public function active( $status )
	{
		$this->active = $status;
		if( $this->save() )
		{
			return true;
		}
		return false;
	}

	public function saveLocation()
	{
		
	}
}
