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
        Schema::create('telegram_bot_group_bot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telegram_bot_group_id');
            $table->unsignedBigInteger('telegraph_bot_id');
            $table->timestamps();

            $table->foreign('telegram_bot_group_id')
                ->references('id')
                ->on('telegram_bot_groups')
                ->cascadeOnDelete();
            $table->foreign('telegraph_bot_id')
                ->references('id')
                ->on('telegraph_bots')
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
        Schema::dropIfExists('telegram_bot_group_bot');
    }
};