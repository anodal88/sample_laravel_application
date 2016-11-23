<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableShippingBox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippingboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('boxname')->unique();
            $table->float('width');
            $table->float('height');
            $table->float('weight');
            $table->float('depth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shippingboxes');
    }
}
