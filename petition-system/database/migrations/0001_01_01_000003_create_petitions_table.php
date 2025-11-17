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
        // This blueprint creates your petitions table
        Schema::create('petitions', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('title');
            $table->text('description');
            $table->string('target')->nullable();
            $table->unsignedInteger('signature_count')->default(0);
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};