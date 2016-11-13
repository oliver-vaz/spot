<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectMapper
{
	private function transform( $obj, $map )
	{
		foreach ( $map as $key )
		{
			$data[ $key ] = $obj->{ $key };
		}
		return $data;
	}

	public function transformArray( $array_objs, $map )
	{
		$array_arrays  = [];
		foreach ($array_objs as $key => $obj )
		{
			if( !is_object($obj) && is_array($obj) )
				return $array_objs;
			$array_arrays[] = $this->transform( $obj, $map );
		}
		return $array_arrays;
	}
}