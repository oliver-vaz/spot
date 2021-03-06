<?php namespace App;

use App\Tariff;
use App\Customer;

class TariffHandler
{
    public function deactivateTariffs( $customer_id )
    {
    	$tariffs = Tariff::where( 'active', 1 )->where( 'customer_id', $customer_id )->get();
    	foreach ( $tariffs as $key => $t )
    	{
    		$t->active = 0;
    		$t->save();
    	}
    }

    public function createNewTariff( Tariff $tariff, Customer $customer, $request )
    {
        $this->deactivateTariffs( $customer->id );
        return $tariff->assignAndSave( $request, $customer );
    }
}
