<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'car_assignments', 
            function( Blueprint $table )
            {
                $table->increments( 'id' );
                $table->integer( 'car_id' )
                        ->unsigned()
                        ->nullable();
                $table->integer( 'driver_id' )
                        ->unsigned()
                        ->nullable();

                $table->timestamps();

                $table->foreign( 'car_id' )
                        ->references( 'id' )
                        ->on( 'cars' )
                        ->onDelete( 'set null' );

                $table->foreign( 'driver_id' )
                        ->references( 'id' )
                        ->on( 'drivers' )
                        ->onDelete( 'set null' );
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
        Schema::drop('car_assignments');
    }
}
