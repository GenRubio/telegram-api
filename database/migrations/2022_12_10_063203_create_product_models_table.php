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
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->text('name')->unique();
            $table->text('image');
            $table->string('reference');
            $table->float('price')->default(0);
            $table->float('discount')->default(0);
            $table->string('size')->nullable();
            $table->string('power_range')->nullable();
            $table->string('input_voltage')->nullable();
            $table->string('battery_capacity')->nullable();
            $table->string('e_liquid_capacity')->nullable();
            $table->string('concentration')->nullable();
            $table->string('resistance')->nullable();
            $table->string('absorbable_quantity')->nullable();
            $table->string('charging_port')->nullable();
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_models');
    }
};
