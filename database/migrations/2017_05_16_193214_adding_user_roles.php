<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'users', function( Blueprint $table){
            $table->enum('role', ['regular', 'admin', 'customer'] )->default('regular');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'users', function( Blueprint $table){
            $table->dropColumn('role');
            $table->dropColumn('active');
        });
    }
}
