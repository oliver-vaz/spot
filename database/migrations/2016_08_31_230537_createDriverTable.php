<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'drivers', function(Blueprint $table ){
            $table->increments( 'id' );
            $table->string('name');
            $table->string('lastname');
            $table->float('wage_per_person');
            $table->float('wage_per_car');
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
        Schema::drop( 'drivers' );
    }
}
