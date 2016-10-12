<?php

namespace Spot;

use Illuminate\Database\Eloquent\Model;

class Additionaldata extends Model
{
    public $timestamps 	= 'false';
    protected $table 	= 'additionaldata';

	public function trips()
	{
		return $this->belongsTo('Trip');
	}
}
