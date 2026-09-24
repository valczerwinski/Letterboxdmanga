<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('manga_reviews', function (Blueprint $table) {
            $table->unsignedInteger('volume_number')->nullable()->after('manga_id');
        });
    }

    public function down(): void
    {
        Schema::table('manga_reviews', function (Blueprint $table) {
            $table->dropColumn('volume_number');
        });
    }
};
