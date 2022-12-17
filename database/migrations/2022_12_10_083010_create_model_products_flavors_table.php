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
            $table->string('reference');
            $table->text('name');
            $table->text('image');
            $table->integer('stock')->default(0);
            $table->integer('stock_bloqued')->default(0);
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
        Schema::dropIfExists('product_models_flavors');
    }
};
