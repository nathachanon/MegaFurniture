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
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name',50);
          $table->string('surname',50);
          $table->string('sex',10);
          $table->date('birthday');
          $table->string('tel',15)->nullable();
          $table->string('email',50)->unique();
          $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
