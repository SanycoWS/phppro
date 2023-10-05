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
        Schema::create('books_with_new_column', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('year')->index();
            $table->string('lang', 24);
            $table->integer('category_id')->index();
            $table->integer('user_id');
            $table->timestamp('date', 4)->index();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::query(); // add trigger for insert, update, delete on books;
        /**
         * after insert book -> insert into books_with_new_column
         * after update book -> update books_with_new_column
         * after delete book -> delete books_with_new_column
         */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_with_new_column');
    }
};
