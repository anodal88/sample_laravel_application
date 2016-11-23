<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEngravedplateIdToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('texts', function (Blueprint $table) {
            $table->integer('engravedplate_id')->unsigned();
            $table->foreign('engravedplate_id')->references('id')->on('engravedplates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('texts', function (Blueprint $table) {
            $table->dropForeign('texts_engravedplate_id_foreign');
            $table->dropColumn('engravedplate_id');
        });
    }
}
