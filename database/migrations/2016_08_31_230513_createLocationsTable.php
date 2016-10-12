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
                $table->integer( 'customer_id' );
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
        Schema::drop('locations');
    }
}
