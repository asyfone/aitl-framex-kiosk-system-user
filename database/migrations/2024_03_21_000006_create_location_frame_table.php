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
        Schema::create('location_frame', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('frame_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            // Add any additional configuration fields here if needed for location-specific frame settings
            // $table->json('settings')->nullable();
            $table->timestamps();

            // Ensure a location can only be linked to a specific frame once
            $table->unique(['location_id', 'frame_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_frame');
    }
};
