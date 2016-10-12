<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'trips', function(Blueprint $table){
            $table->increments( 'id' );
            $table->dateTime( '_date' );
            $table->integer( 'location_id' );
            $table->integer( 'tariff_id' );
            $table->integer( 'driver_id' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'trips' );
    }
}
