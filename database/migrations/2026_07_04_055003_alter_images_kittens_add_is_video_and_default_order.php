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
        Schema::table('images_kittens', function (Blueprint $table) {
            $table->boolean('is_video')->default(false)->after('image_path');
            $table->integer('order')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images_kittens', function (Blueprint $table) {
            $table->dropColumn('is_video');
            $table->integer('order')->change(); // Rétablit sans défaut (dépend du driver mais c'est le comportement standard)
        });
    }
};
