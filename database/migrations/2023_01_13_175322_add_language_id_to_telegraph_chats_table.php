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
        Schema::table('telegraph_chats', function (Blueprint $table) {
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
        Schema::table('telegraph_chats', function (Blueprint $table) {
            $table->dropColumn([
                'language_id'
            ]);
        });
    }
};
