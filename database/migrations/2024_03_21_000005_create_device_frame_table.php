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
        Schema::create('device_frame', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('frame_id')->constrained()->onDelete('cascade');
            // Add any additional configuration fields here if needed
            // $table->json('settings')->nullable();
            $table->timestamps();

            // Ensure a device can only be linked to a specific frame once
            $table->unique(['device_id', 'frame_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_frame');
    }
};
