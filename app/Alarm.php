<?php

namespace Spot;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{

    public function assignAndSave( $request )
    {

    	$this->title 	= $request['a-title'];
    	$this->content  = $request['a-content'];
    	$this->car_id 	= $request['a-id-car'];
    	$this->task_id  = $request['a-id-task'];
    	$this->active 	= 1;

    	if( $this->save() )
    		return true;
    	return false;
    }

    public function active( $status )
    {
    	$this->active = $status;

    	if( $this->save() ){
    		return true;
    	}
    	return false;
    }
}
