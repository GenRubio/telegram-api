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
        Schema::create('product_model_valorations', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->unsignedBigInteger('product_model_id');
            $table->integer('stars')->default(5);
            $table->string('comment')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('chat_id')
                ->on('telegraph_chats')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('product_model_valorations');
    }
};
