<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->renameColumn('ordered_for', 'ordered_for_id');
            $table->renameColumn('ordered_from', 'ordered_from_id');
            $table->renameColumn('created_by', 'created_by_id');
            $table->renameColumn('delivered_by', 'delivered_by_id');
            $table->renameColumn('delivered_to', 'delivered_to_id');
            $table->renameColumn('handed_to', 'handed_to_id');
        });
    }

    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->renameColumn('ordered_for_id', 'ordered_for');
            $table->renameColumn('ordered_from_id', 'ordered_from');
            $table->renameColumn('created_by_id', 'created_by');
            $table->renameColumn('delivered_by_id', 'delivered_by');
            $table->renameColumn('delivered_to_id', 'delivered_to');
            $table->renameColumn('handed_to_id', 'handed_to');
        });
    }
};
