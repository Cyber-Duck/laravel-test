<?php

use App\Models\Shipping;
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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->decimal('cost');
            $table->timestamps();
        });

        $shipping = Shipping::create([
            'cost' => 10,
        ]);

        Schema::table('sales', function (Blueprint $table) use ($shipping) {
            $table->bigInteger('shipping_id')->index()->default($shipping->id)->after('unit_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('shipping_id');
        });

        Schema::dropIfExists('shippings');
    }
};
