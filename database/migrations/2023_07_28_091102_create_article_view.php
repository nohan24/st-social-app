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
        DB::statement("CREATE VIEW v_join_article_categorie AS SELECT a.*,c.nom FROM articles a LEFT OUTER JOIN categorie_articles c ON c.categorie_id = a.categorie_id");
        DB::statement("CREATE VIEW v_articles AS SELECT v.*,u.name,u.prenom FROM v_join_article_categorie v JOIN users u ON v.user_id = u.user_id");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_view');
    }
};
