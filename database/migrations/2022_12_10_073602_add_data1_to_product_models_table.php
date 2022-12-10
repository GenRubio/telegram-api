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
        Schema::table('product_models', function (Blueprint $table) {
            $table->string('size')->nullable();
            $table->string('power_range')->nullable();
            $table->string('input_voltage')->nullable();
            $table->string('battery_capacity')->nullable();
            $table->string('e_liquid_capacity')->nullable();
            $table->string('concentration')->nullable();
            $table->string('resistance')->nullable();
            $table->string('absorbable_quantity')->nullable();
            $table->string('charging_port')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_models', function (Blueprint $table) {
            //
        });
    }
};
