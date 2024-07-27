<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('stage_items', 'stage_item');
    }

    public function down(): void
    {
        Schema::rename('stage_item', 'stage_items');
    }
};
