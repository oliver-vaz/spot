<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKmCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'cars',
            function( Blueprint $table )
            {
                $table->integer( 'km', false );
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
        Schema::table( 'cars', 
            function( Blueprint $table )
            {
                $table->dropColumn( 'km' );
            }
        );
    }
}
