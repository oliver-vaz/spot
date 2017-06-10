<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingNolicenseCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'cars', function( Blueprint $table ){ 
            $table->integer('insurance_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'cars', function( Blueprint $table ){
            $table->dropColumn('insurance_number');
        });
    }
}
