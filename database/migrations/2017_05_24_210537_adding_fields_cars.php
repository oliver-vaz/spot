<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingFieldsCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'cars', function( Blueprint $table ){ 
            $table->date('insurance_end');
            $table->string('insurance_company');
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
            $table->dropColumn('insurance_end');
            $table->dropColumn('insurance_company');
        });
    }
}
