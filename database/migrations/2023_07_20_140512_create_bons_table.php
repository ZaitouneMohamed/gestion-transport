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
        Schema::create('bons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consomation_id')->unsigned();
            $table->foreign('consomation_id')->references('id')->on('consomations')->onDelete('cascade');
            $table->date("date");
            $table->string("qte_litre");
            $table->double("prix");
            $table->foreignId('station_id')->unsigned();
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->string("numero_bon")->nullable();
            $table->double("km")->default(0);
            $table->string("nature");
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
        Schema::dropIfExists('bons');
    }
};
