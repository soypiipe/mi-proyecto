<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //metodo up se define lo que se va hacer con 
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();//No representa ningun tipo de dato en la base de datos
            $table->timestamps(); //Marcas de tiempo - Se crean dos columnas created_at y update_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
