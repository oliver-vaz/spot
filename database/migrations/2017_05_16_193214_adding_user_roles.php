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
        DB::table( 'users', function($table){
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
        DB::table( 'users', function($table){
            $table->dropColumn('role');
            $table->dropColumn('active');
        });
    }
}
