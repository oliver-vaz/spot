<?php

namespace App\Traits;

use Validator;

trait validating {
	/**
	 * Validating the input
	 * @param $request
	 * @return Array with status
 	 */
	private function validate( Array $input )
	{
		$validator = Validator::make( $input , $this->rules );
		if( $validator->fails() )
			return [ 'status' => false, 'errors' => $validator ];
		return [ 'status' => true ];
	}

}