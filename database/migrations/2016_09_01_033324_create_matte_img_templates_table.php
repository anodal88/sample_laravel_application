<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatteImgTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgtemplate_mattetemplate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mattetemplate_id')->unsigned();
            $table->integer('imgtemplate_id')->unsigned();

            $table->foreign('mattetemplate_id')->references('id')->on('matte_templates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('imgtemplate_id')->references('id')->on('img_templates')
                ->onUpdate('cascade')->onDelete('cascade');

//            $table->primary(['id', 'mattetemplate_id', 'imgtemplate_id'], 'id_imagetpl_matte_primary');
            $table->integer('row');
            $table->integer('column');
            $table->integer('rowspan');
            $table->integer('colspan');
            $table->float('marginTop');
            $table->float('marginLeft');
            $table->float('marginRight');
            $table->float('marginBottom');
            $table->integer('order');
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
        Schema::drop('imgtemplate_mattetemplate');
    }
}
