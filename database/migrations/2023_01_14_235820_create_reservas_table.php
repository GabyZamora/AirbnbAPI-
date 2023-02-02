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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('checkin');
            $table->string('checkout');
            $table->unsignedBigInteger('lugar_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('numhuesped')->nullable();
            $table->string('preciototal')->default(30);
            $table->string('estado')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('lugar_id')->references('id')->on('lugars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};
