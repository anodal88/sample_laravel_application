<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngravedPlates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engravedplates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->float('width');
            $table->float('height');
            $table->longText('plateStyle');
            $table->longText('textStyle');
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
        Schema::drop('engravedplates');
    }
}
