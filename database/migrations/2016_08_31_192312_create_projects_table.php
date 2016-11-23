<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('hash_name', 255)->unique();
            $table->float('price');
            $table->longText('preview');
            $table->boolean('favorite')->default(false);
            $table->integer('frame_id')->unsigned();
            $table->integer('background_color_id')->unsigned();
            $table->integer('matte_template_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->integer('order_id')->unsigned()->nullable();


            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');


            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');


            $table->foreign('matte_template_id')
                ->references('id')->on('matte_templates')
                ->onDelete('cascade');


            $table->foreign('background_color_id')
                ->references('id')->on('colors')
                ->onDelete('cascade');


            $table->foreign('frame_id')
                ->references('id')->on('frames')
                ->onDelete('cascade');

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
        Schema::drop('projects');
    }
}
