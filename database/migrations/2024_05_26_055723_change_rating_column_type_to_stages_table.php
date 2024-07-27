<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->string('kitchen_rating')->nullable()->change();
            $table->string('delivery_rating')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->integer('kitchen_rating')->nullable()->change();
            $table->integer('delivery_rating')->nullable()->change();
        });
    }
};
