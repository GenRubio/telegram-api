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
        Schema::create('product_models_flavors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_model_id');
            $table->text('name')->unique();
            $table->text('image');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('product_model_id')
                ->references('id')
                ->on('product_models')
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
        Schema::dropIfExists('model_products_flavors');
    }
};
