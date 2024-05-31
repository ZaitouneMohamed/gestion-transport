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
        Schema::create('reparation_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reparation_id')->unsigned();
            $table->foreign('reparation_id')->references('id')->on('reparations')->onDelete('cascade');
            $table->foreignId('chaufeur_id')->unsigned();
            $table->foreign('chaufeur_id')->references('id')->on('chaufeurs')->onDelete('cascade');
            $table->foreignId('camion_id')->unsigned();
            $table->foreign('camion_id')->references('id')->on('camions')->onDelete('cascade');
            $table->double("prix");
            $table->date("date");
            $table->string("nature");
            $table->foreignId('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('natures')->onDelete('cascade');
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
        Schema::dropIfExists('reparation_infos');
    }
};
