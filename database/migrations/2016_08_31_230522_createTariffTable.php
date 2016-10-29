<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'tariffs', function(Blueprint $table){
            $table->increments('id');
            $table->date( 'init_date' );
            $table->date( 'end_date' );
            $table->boolean( 'active' );
            $table->float( 'price_per_car' );
            $table->float( 'price_per_person' );
            $table->integer( 'customer_name' );
            $table->integer( 'customer_id' )
                    ->unsigned()
                    ->nullable();
            $table->timestamps();

            $table->foreign( 'customer_id' )
                    ->references('id')
                    ->on('customers')
                    ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tariffs');
    }
}
