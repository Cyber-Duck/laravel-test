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
        Schema::create('coffee_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedDecimal('profit_margin')->nullable(false)->default(0.25);
            $table->unsignedDecimal('shipping_costs')->nullable(false)->default(10.00);
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
        Schema::dropIfExists('coffee_types');
    }
};
