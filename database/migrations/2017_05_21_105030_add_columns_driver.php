<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'drivers', function( Blueprint $table){
                $table->string('alias');
                $table->string('address');
                $table->string('phone');
                $table->string('cellphone');
                $table->string('number_licence');
                $table->date('end_licence');
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
        Schema::table( 'drivers', function( Blueprint $table){
                $table->dropColumn('alias');
                $table->dropColumn('address');
                $table->dropColumn('phone');
                $table->dropColumn('cellphone');
                $table->dropColumn('number_licence');
                $table->dropColumn('end_licence');
            });
    }
}
