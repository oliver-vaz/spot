<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveFieldAssigmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'car_assignments', 
            function( Blueprint $table )
            {
                $table->boolean( 'active' )->default( true );
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
        Schema::table( 'car_assignments',
            function( Blueprint $table )
            {
                $table->dropColumn( 'active' );
            }
        );
    }
}
