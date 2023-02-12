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
        Schema::create('parametric_table_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parametric_table_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('parameter');
            $table->boolean('resource')->default(true);
            $table->boolean('filter')->default(true);
            $table->boolean('visible')->default(true);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('parametric_table_id')
                ->references('id')
                ->on('parametric_tables')
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
        Schema::dropIfExists('parametric_table_values');
    }
};
