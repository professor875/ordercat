<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->string('delivered_by_type')->nullable()->after('delivered_by_id');
            $table->string('handed_to_type')->nullable()->after('handed_to_id');
        });
    }

    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropColumn(['delivered_by_type', 'handed_to_type']);
        });
    }
};
