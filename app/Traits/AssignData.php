<?php

namespace App\Traits;

trait assignData
{
	function assignInputToFields( $input, $map_fields )
	{
		foreach ( $map_fields as $key => $value) 
		{
			$this->{ $key } = $input[ $value ];
		}
	}
}