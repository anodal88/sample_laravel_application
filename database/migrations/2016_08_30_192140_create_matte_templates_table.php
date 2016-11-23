<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatteTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matte_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->enum('orientation', ['Vertical', 'Horizontal']);
            $table->string('description');
            $table->longText('thumbnail');
            $table->float('height');
            $table->float('width');
            $table->float('margin');
            $table->integer('rows');
            $table->integer('columns');
            $table->text('html_template');


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
        Schema::drop('matte_templates');
        Schema::dropIfExists('matte_img_templates');
    }
}
