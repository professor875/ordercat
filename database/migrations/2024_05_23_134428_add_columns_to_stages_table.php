<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->timestamp('packaging_at')->nullable()->after('created_by');
            $table->timestamp('cooked_at')->nullable()->after('created_by');
        });
    }

    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropColumn(['packaging_at', 'cooked_at']);
        });
    }
};
