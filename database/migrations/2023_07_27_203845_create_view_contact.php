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
        DB::statement("CREATE VIEW v_user_contacts AS SELECT contact_id,u.user_id,u.name,prenom,date_naissance,date_embauche,sexe,u.role_id,libelle,telephone,adresse1,adresse2,ville,pays,cp FROM v_user_dispos u JOIN contacts c ON u.user_id = c.user_id JOIN roles p ON u.role_id = p.role_id");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_contact');
    }
};
