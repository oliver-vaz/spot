<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'additionaldata', function(Blueprint $table){
            $table->increments( 'id' );
            $table->integer( 'trip_id' );
            $table->string( 'description' );
            $table->float( 'price' );
            $table->integer( 'no_people' );
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
        Schema::drop( 'additionaldata' );
    }
}
