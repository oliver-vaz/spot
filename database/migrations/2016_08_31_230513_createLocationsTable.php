<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'locations', 
            function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name');
                $table->string('description');
                $table->string( 'customer_name' );
                $table->integer( 'customer_id' )
                        ->unsigned()
                        ->nullable();
                $table->timestamps();

                $table->foreign( 'customer_id' )
                        ->references('id')
                        ->on('customers')
                        ->onDelete('set null');
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
        Schema::drop('locations');
    }
}
