<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->string('titre')->nullable();
            $table->longText('texte');
            $table->json('rating')->nullable()->default('{"likes":[], "dislikes":[]}');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->foreign('categorie_id')->references('categorie_id')->on('categorie_articles');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE articles CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
