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
        Schema::table('coffee_types', function (Blueprint $table) {
            $table->dropColumn('shipping_costs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coffee_types', function (Blueprint $table) {
            $table->unsignedDecimal('shipping_costs')->nullable(false)->default(10.00)->after('profit_margin');
        });
    }
};
