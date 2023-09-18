<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('views');
            $table->integer('comments');
            $table->integer('repost');
            $table->integer('share');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_statistcs');
    }
};
