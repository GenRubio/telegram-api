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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->text('reference');
            $table->string('name');
            $table->string('surnames');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country')->default('España');
            $table->string('payment_method');
            $table->string('status');
            $table->float('price')->default(0);
            $table->float('shipping_price')->default(0);
            $table->float('total_price')->default(0);
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('chat_id')
                ->on('telegraph_chats')
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
        Schema::dropIfExists('orders');
    }
};
