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
        Schema::table('telegraph_bots', function (Blueprint $table) {
            $table->text('bot_url')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->unsignedInteger('language_id')->nullable();

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
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
        Schema::table('telegraph_bots', function (Blueprint $table) {
            $table->dropColumn([
                'bot_url',
                'title',
                'description',
                'image',
                'language_id'
            ]);
        });
    }
};
