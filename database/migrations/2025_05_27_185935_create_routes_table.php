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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Laravel route name (e.g. "posts.edit")
            $table->string('uri'); // Optional, like "posts/{post}/edit"
            $table->string('method'); // GET, POST, etc.
            $table->string('label')->nullable(); // Human-friendly label like "Edit Post Page"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
