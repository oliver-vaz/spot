<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'maintenances',
            function( Blueprint $table )
            {
                $table->increments( 'id' );
                $table->string( 'made_by' );
                $table->string( 'comments' );
                $table->integer( 'period' );
                $table->integer( 'car_id' )
                        ->unsigned()
                        ->nullable();
                $table->integer( 'task_id' )
                        ->unsigned()
                        ->nullable();
                $table->timestamps();

                $table->foreign('task_id')
                        ->references( 'id' )
                        ->on( 'tasks' )
                        ->onDelete( 'set null' );

                $table->foreign('car_id')
                        ->references( 'id' )
                        ->on( 'cars' )
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
        Schema::drop( 'maintenances' );
    }
}
