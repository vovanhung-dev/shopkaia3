<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Schema::table('top_up_services', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('game_id');
            $table->foreign('category_id')->references('id')->on('top_up_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('top_up_services', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}; 