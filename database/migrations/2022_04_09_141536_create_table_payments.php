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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->date('date_of_pay');
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('subscribetion_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('subscribetion_id')->references('id')->on('subscribetions');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('payments');
    }
};
