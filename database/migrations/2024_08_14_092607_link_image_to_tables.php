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
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->foreignId('image_id')
                ->nullable()
                ->after('old_price')
                ->references('id')
                ->on('images')
                ->nullOnDelete();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->foreignId('image_id')
                ->nullable()
                ->after('description')
                ->references('id')
                ->on('images')
                ->nullOnDelete();
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->foreignId('image_id')
                ->nullable()
                ->after('link')
                ->references('id')
                ->on('images')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('image_id');
            $table->string('image')->nullable()->after('old_price');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('image_id');
            $table->string('image')->nullable()->after('description');
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('image_id');
            $table->string('image')->nullable()->after('link');
        });
    }
};
