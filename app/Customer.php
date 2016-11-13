<?php

namespace App;

use Validator;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AssignData;
use App\Traits\Active;

class Customer extends Model
{
	use assignData, active;

    protected $table	= 'customers';
    private $map_fields	= [
    			'name' 			=> 'name',
    			'short_name' 	=> 'shortname',
    			'rfc' 			=> 'rfc',
    			'phone' 		=> 'phone',
    			'cellphone' 	=> 'cellphone',
    			'alter_phone' 	=> 'alterphone',
    			'zipcode' 		=> 'zipcode',
    			'address' 		=> 'address',
    			'city' 			=> 'city'
    ]; 

	public function tariffs()
	{
		return $this->hasMany('Tariff');
	}

	public function locations()
	{
		return $this->hasMany('Location');
	}

    /**
     * Assing data and save in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean $response
     */
	public function assignAndSave( $request )
	{
		$this->assignInputToFields( $request, $this->map_fields );
        $this->active = true;
		
		if( !$this->validate($request)['status'] )
			return false;

        try{
	        if( $this->save() )
	        	return [ 'status' => true ];
        }catch( Exception $e ){
	        return [ 'status' => false ];
        }
        return [ 'status' => false ];
	}

    /**
     * Validating data.
     * @param  Array $request
     * @return boolean
     */
	private function validate( Array $request )
	{
		$validator = Validator::make( $request, [
                'name' => 'required|string',
                'shortname' => 'required|string'
        ]);

		if( $validator->fails() )
			return [ 'status' => false, 'errors' => $validator ];
		return [ 'status' => true ];
	}

}
