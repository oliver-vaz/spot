<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Validating;
use App\Traits\AssignData;
use App\Traits\Active;

class CarDriver extends Model
{
	use assignData, active, validating;

    protected $table	= 'drivers';
    private $rules		= [
        'name' 				=> 'required|string',
        'last_name' 		=> 'required|string',
        'wage_per_person' 	=> 'required|numeric',
        'wage_per_car' 		=> 'required|numeric',
    ];
    private $map_fields = [
    	'name' 				=> 'name',
    	'lastname'			=> 'last_name',
    	'wage_per_person' 	=> 'wage_per_person',
    	'wage_per_car' 		=> 'wage_per_car'
    ];

    /**
     * Relationship with Trips entities.
     */
	public function trips()
	{
		return $this->hasMany('Trip');
	}

    /**
     * Assing data and save in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean $response
     */
	public function assignAndSave( $request )
	{
		$valid = $this->validate($request);
		if( !$valid['status'] )
			return $valid;
		$this->assignInputToFields( $request, $this->map_fields );

        try {
	        if( $this->save() )
	        	return [ 'status' => true ];
        } catch( Exception $e ) {
	        return [ 'status' => false, 'errors' => $e->getTrace() ];
        }
        return [ 'status' => false ];
	}
}