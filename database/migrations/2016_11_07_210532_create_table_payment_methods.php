<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('localizator',255);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('number',19);//Between 16 and 19
            $table->integer('expire_month')->unsigned();//Between 1 and 2
            $table->integer('expire_year')->unsigned();
            $table->enum('type',['visa','mastercard','amex','discover','maestro']);
            $table->string('valid_until',255);
            $table->string('country_code',2);
            $table->string('postal_code',10);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
       Schema::drop('credit_cards');
    }
}
