<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDataTypeByError extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'tariffs', function( Blueprint $table ){
            $table->dropColumn('customer_name');
            $table->string('customername');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tariffs', function( Blueprint $table ){
            $table->dropColumn('customer_name');
            $table->integer('customer_name');
        });
    }
}
