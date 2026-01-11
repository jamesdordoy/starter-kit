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
        Schema::table('routes', function (Blueprint $table) {
            // Drop the unique constraint on name alone
            $table->dropUnique(['name']);

            // Add composite unique constraint on name + method
            $table->unique(['name', 'method'], 'routes_name_method_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            // Drop the composite unique constraint
            $table->dropUnique('routes_name_method_unique');

            // Restore unique constraint on name alone
            $table->unique('name');
        });
    }
};
