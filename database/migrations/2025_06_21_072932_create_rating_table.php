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
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('peminjaman_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('armada_id');
            $table->integer('rating')->default(0); // 1-5 stars
            $table->text('review')->nullable();
            $table->timestamps();
            
            // Ensure one rating per booking
            $table->unique('peminjaman_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
