<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingboxIdToMatteTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matte_templates', function (Blueprint $table) {
            $table->integer('shippingbox_id')->unsigned()->nullable();
            $table->foreign('shippingbox_id')->references('id')->on('shippingboxes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matte_templates', function (Blueprint $table) {
            $table->dropForeign('matte_templates_shippingbox_id_foreign');
            $table->dropColumn('shippingbox_id');
        });
    }
}
