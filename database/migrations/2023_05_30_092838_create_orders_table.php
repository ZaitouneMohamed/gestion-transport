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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("order_number");
            $table->string("customer_name");
            $table->string("customer_email");
            $table->string("customer_phone");
            $table->date("delivery_date");
            $table->string("adresse");
            $table->string("category");
            $table->string("subCategory");
            $table->string("product");
            $table->integer("qty");
            $table->string("payement");
            $table->string("branch");
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
        Schema::dropIfExists('orders');
    }
};
