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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity')->nullable(false);
            $table->unsignedDecimal('unit_price')->nullable(false);
            $table->unsignedBigInteger('coffee_type_id')->nullable(false);
            $table->unsignedBigInteger('agent_id')->nullable(false);
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('users');
            $table->foreign('coffee_type_id')->references('id')->on('coffee_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
