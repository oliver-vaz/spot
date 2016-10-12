<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'alarms', 
            function( Blueprint $table )
            {
                $table->increments('id');
                $table->string('title');
                $table->string('content');
                $table->boolean('active');
                $table->integer('task_id')->unsigned()->nullable();
                $table->integer('car_id')->unsigned()->nullable();
                $table->timestamps();
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
        Schema::drop( 'alarms' );
    }
}
