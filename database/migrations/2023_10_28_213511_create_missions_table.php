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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->foreignId('chaufeur_id')->unsigned();
            $table->foreign('chaufeur_id')->references('id')->on('chaufeurs')->onDelete('cascade');
            $table->foreignId('camion_id')->unsigned();
            $table->foreign('camion_id')->references('id')->on('camions')->onDelete('cascade');
            $table->foreignId('ville_id')->unsigned();
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('cascade');
            $table->integer("nombre_magasin");
            $table->float("km_total");
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
        Schema::dropIfExists('missions');
    }
};
