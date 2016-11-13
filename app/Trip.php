<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table	= 'trips';

	public function tariffs()
	{
		return $this->belongsTo('Tariff');
	}

	public function locations()
	{
		return $this->belongsTo('Locations');
	}

	public function tariffs()
	{
		return $this->belongsTo('Tariff');
	}

	public function drivers()
	{
		return $this->belongsTo('CarDriver');
	}

	public function additionadata()
	{
		return $this->hasOne('Additionaldata');
	}

}
