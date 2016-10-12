<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'cars', 
            function( Blueprint $table )
            {
                $table->increments( 'id' );
                $table->string( 'marca' );
                $table->string( 'modelo' );
                $table->string( 'placas' );
                $table->string( 'anio' );
                $table->float( 'insurance_price' );
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'cars' );
    }
}
