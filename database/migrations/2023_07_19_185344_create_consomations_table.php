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
        Schema::create('consomations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chaufeur_id')->unsigned();
            $table->foreign('chaufeur_id')->references('id')->on('chaufeurs')->onDelete('cascade');
            $table->foreignId('camion_id')->unsigned();
            $table->foreign('camion_id')->references('id')->on('camions')->onDelete('cascade');
            $table->string("ville");
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
        Schema::dropIfExists('consomations');
    }
};
