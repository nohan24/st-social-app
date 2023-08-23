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
        DB::statement("CREATE VIEW v_cotisations AS SELECT c.*, u.name, u.prenom FROM cotisations c JOIN users u ON c.user_id = u.user_id");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
