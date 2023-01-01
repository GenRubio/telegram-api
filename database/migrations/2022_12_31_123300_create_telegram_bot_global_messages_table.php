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
        Schema::create('telegram_bot_global_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telegram_bot_group_id');
            $table->text('image')->nullable();
            $table->string('description');
            $table->text('message');
            $table->dateTime('execution_date');
            $table->string('status');
            $table->timestamps();

            $table->foreign('telegram_bot_group_id')
                ->references('id')
                ->on('telegram_bot_groups')
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
        Schema::dropIfExists('telegram_bot_global_messages');
    }
};
