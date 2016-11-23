<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImgTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->enum('orientation', ['Portrait', 'Landscape']);
            $table->float('cornerRadio');
            $table->float('height');
            $table->float('width');
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
        Schema::drop('img_templates');
    }
}
