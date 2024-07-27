<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->string('employees_rating')->nullable()->change();
            $table->string('instruments_rating')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->integer('employees_rating')->nullable()->change();
            $table->integer('instruments_rating')->nullable()->change();
        });
    }
};
