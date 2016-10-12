<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'customers', function( Blueprint $table ){
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->string( 'short_name' );
            $table->string( 'phone' );
            $table->string( 'cellphone' );
            $table->string( 'alter_phone' );
            $table->string( 'rfc', 20 );
            $table->string( 'zipcode', 10 );
            $table->string( 'address' );
            $table->string( 'city' );
            $table->boolean( 'active' );
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
        Schema::drop( 'customers' );
    }
}
