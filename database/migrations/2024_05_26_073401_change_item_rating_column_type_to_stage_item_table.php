<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stage_item', function (Blueprint $table) {
            $table->string('item_rating')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('stage_item', function (Blueprint $table) {
            $table->integer('item_rating')->nullable()->change();
        });
    }
};
