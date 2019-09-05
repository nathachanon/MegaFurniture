<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',50)->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('promotions', function (Blueprint $table) {
         $table->unsignedInteger('admin_id');
         $table->increments('promotion_id');
         $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
         $table->string('promotion_name',200);
         $table->text('promotion_des');
         $table->string('promotion_pic',50)->nullable();
         $table->integer('promotion_status');
         $table->timestamps();
     });

        Schema::create('contents', function (Blueprint $table) {
         $table->unsignedInteger('admin_id');
         $table->increments('content_id');
         $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
         $table->string('content_name',200);
         $table->longtext('content_des');
         $table->string('content_pic',50)->nullable();
         $table->integer('content_status');
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
        Schema::dropIfExists('admin');
    }
}
