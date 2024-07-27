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
        Schema::table('stages', function (Blueprint $table) {
            $table->after('kitchen_rating', function ($table) {
                $table->integer('instruments_rating')->nullable()->comment('[excellent, very good, good, acceptable, bad] should be made by handed_to');
                $table->integer('employees_rating')->nullable()->comment('[excellent, very good, good, acceptable, bad] should be made by handed_to');
                $table->string('note')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->dropColumn('instruments_rating');
            $table->dropColumn('employees_rating');
            $table->dropColumn('note');

        });
    }
};
