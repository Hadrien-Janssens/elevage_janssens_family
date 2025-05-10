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
            $table->string('gender')->nullable();
            $table->string('description')->nullable();
            $table->boolean('vaccination')->default(false);
            $table->boolean('sterilization')->default(false);
            $table->date('published_at')->nullable()->default(null);
            $table->boolean('chip')->default(false);
            $table->decimal('price', 8, 2)->nullable();
            $table->foreignId('litter_id')->constrained('litters')->onDelete('cascade');
            $table->text('race')->nullable();
            $table->text('body_color')->nullable();
            $table->boolean('is_booked')->default(false);
            $table->boolean('is_adopted')->default(false);
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
