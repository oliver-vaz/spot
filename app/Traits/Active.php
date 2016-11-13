<?php

namespace App\Traits;

trait active
{
    public function active( $status )
    {
    	$this->active = $status;
    	try
    	{
    		return $this->save();
    	}
    	catch( Exception $e )
    	{
    		return false;
    	}
    }
	
}