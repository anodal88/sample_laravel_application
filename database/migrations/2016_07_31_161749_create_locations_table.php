<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('address')->nullable();


            $table->integer('city_id')->unsigned();

            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');

            $table->string('appartment_number', 45)->default('');
            $table->string('zip_code', 10);
            $table->string('longitude', 10);
            $table->string('latitude', 10);
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
        Schema::drop('locations');
    }
}
