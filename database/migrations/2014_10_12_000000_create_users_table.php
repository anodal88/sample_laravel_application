<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creamos la tabla users con los campos más básicos.
        Schema::create('users',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',255);
            $table->string('username',255)->unique();
            $table->string('email',255)->unique();
            $table->boolean("active");
            $table->string('password',60);
            $table->rememberToken();
            $table->string('api_token', 60)->unique();
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
        // Eliminar la tabla users
        Schema::drop('users');
    }

}