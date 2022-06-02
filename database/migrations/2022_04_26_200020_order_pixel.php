<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pixel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 255)->nulltable(false);
            $table->string('name_img', 255)->nulltable(false);
            $table->string('name_gif', 255)->nulltable(false);
            $table->string('coords', 255)->nulltable(false);
            $table->string('position', 255)->nulltable(false);
            $table->string('url', 400)->nulltable(false);
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
        Schema::dropIfExists('order_pixel');
    }
};
