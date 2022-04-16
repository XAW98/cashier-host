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
        // Schema::create('clients', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('full_name');
        //     $table->string('email')->unique();
        //     $table->integer('phone')->unique();
        //     $table->string('password', 60);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('clinets');
    }
};
