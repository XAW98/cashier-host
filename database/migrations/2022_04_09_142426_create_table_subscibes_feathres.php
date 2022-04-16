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
        Schema::create('subscribes_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('limitation');
            $table->string('status');
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('subscribetion_id');
            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('subscribetion_id')->references('id')->on('subscribetions');
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
        Schema::dropIfExists('subscribes_features');
    }
};
