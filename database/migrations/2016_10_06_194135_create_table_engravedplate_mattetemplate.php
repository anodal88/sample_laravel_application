<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEngravedplateMattetemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engravedplate_mattetemplate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('engravedplate_id')->unsigned();
            $table->integer('mattetemplate_id')->unsigned();

            $table->foreign('mattetemplate_id')->references('id')->on('matte_templates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('engravedplate_id')->references('id')->on('engravedplates')
                ->onUpdate('cascade')->onDelete('cascade');

//            $table->primary(['engravedplate_id', 'mattetemplate_id'],'engravedplate_mattetemplate_primary');
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
        Schema::drop('engravedplate_mattetemplate');
    }
}
