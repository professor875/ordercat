<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void
    {
        Schema::table('stage_item', function (Blueprint $table) {
            $table->renameColumn('item_evaluation', 'item_rating');
        });
    }

    public function down(): void
    {
        Schema::table('stage_item', function (Blueprint $table) {
            $table->renameColumn('item_rating', 'item_evaluation');
        });
    }
};
