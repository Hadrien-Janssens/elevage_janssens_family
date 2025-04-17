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
        Schema::create('kittens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->boolean('adopted')->default(false);
            $table->string('description')->nullable();
            $table->boolean('vaccination')->default(false);
            $table->boolean('sterilization')->default(false);
            $table->boolean('chip')->default(false);
            $table->decimal('price', 8, 2)->nullable();
            $table->foreignId('litter_id')->constrained('litters')->onDelete('cascade');
            $table->foreignId('body_color_id')->nullable()->constrained('body_colors')->nullOnDelete();
            $table->boolean('booked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kittens');
    }
};
