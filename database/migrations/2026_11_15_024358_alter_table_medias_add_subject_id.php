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
    Schema::table('medias', function (Blueprint $table) {
        $table->foreignId('subject_id')->after('author_id')->constrained()->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('medias', function (Blueprint $table) {
        $table->dropConstrainedForeignId('subject_id');
    });
}
};
