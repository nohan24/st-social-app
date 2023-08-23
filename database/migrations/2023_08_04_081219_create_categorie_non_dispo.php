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
        Schema::create('categorie_non_dispos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('categorie_id')->on('categorie_articles');
            $table->timestamps();
        });

        DB::statement("CREATE VIEW v_categorie_dispos AS SELECT * FROM categorie_articles WHERE categorie_id NOT IN (SELECT categorie_id FROM categorie_non_dispos)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_non_dispo');
    }
};
