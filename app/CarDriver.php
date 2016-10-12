<?php

namespace Spot;

use Validator;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    protected $table	= 'drivers';


    /**
     * Relationship with Trips entities.
     */
	public function trips()
	{
		return $this->hasMany('Trip');
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
        $this->name 			= $request['name'];
        $this->lastname 		= $request['last_name'];
        $this->wage_per_person 	= $request['wage_per_person'];
        $this->wage_per_car 	= $request['wage_per_car'];

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
                'last_name' => 'required|string',
                'wage_per_person' => 'required|numeric',
                'wage_per_car' => 'required|numeric',
        ]);

		if( $validator->fails() )
		{
			return [ 'status' => false, 'errors' => $validator ];
		}
		return [ 'status' => true ];
	}

	public function active( $status ){
		$this->active = $status;

		if( $this->save() )
		{
			return true;
		}
		return false;
	}

}
