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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telegraph_bot_id');
            $table->string('name');
            $table->string('surnames');
            $table->string('email');
            $table->text('password')->nullable();
            $table->string('phone');
            $table->string('nif');
            $table->string('iban');
            $table->string('reference');
            $table->boolean('active')->default(true);
            $table->timestamps();

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
        Schema::dropIfExists('affiliates');
    }
};
