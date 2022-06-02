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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->nulltable(false)->unique('email');
            $table->string('password', 255)->nulltable(false);
            $table->string('name', 25)->nulltable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nulltable(true);
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
};
