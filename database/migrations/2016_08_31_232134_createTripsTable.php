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
            $table->integer( 'location_id' )
                    ->unsigned()
                    ->nullable();

            $table->integer( 'tariff_id' )
                    ->unsigned()
                    ->nullable();

            $table->integer( 'driver_id' )
                    ->unsigned()
                    ->nullable();

            $table->timestamps();

            $table->foreign( 'location_id' )
                    ->references('id')
                    ->on('locations')
                    ->onDelete('set null');

            $table->foreign( 'tariff_id' )
                    ->references('id')
                    ->on('tariffs')
                    ->onDelete('set null');

            $table->foreign( 'driver_id' )
                    ->references('id')
                    ->on('drivers')
                    ->onDelete('set null');

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
