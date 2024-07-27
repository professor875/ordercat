<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stage_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreignId('item_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->bigInteger('quantity');
            $table->bigInteger('delivered_quantity')->nullable();
            $table->integer('item_evaluation')
                ->nullable()
                ->comment('1-5 stars, made by handed_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_items');
    }
};
