<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('ordered_for');
            $table->foreignId('ordered_from');
            $table->timestamp('delivery_at')->comment('Estimated/Requested time of delivery');
            $table->foreignId('created_by');
            $table->timestamp('started_at')->nullable();
            $table->foreignId('delivered_by')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->foreignId('delivered_to')->nullable();
            $table->foreignId('handed_to')->comment('A contact who can evaluate [delivery, kitchen and items]')->nullable();
            $table->timestamp('handed_at')->nullable();
            $table->integer('delivery_rating')->nullable()->comment('1-5 stars should be made by handed_to');
            $table->integer('kitchen_rating')->nullable()->comment('1-5 stars, made by handed_to (which user will do)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
