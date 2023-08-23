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
        Schema::create('type_evt_non_dispos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('type_evenements');
            $table->timestamps();
        });
        
        DB::statement('CREATE VIEW v_type_evt_dispos AS SELECT * FROM type_evenements WHERE id NOT IN (SELECT type_id FROM type_evt_non_dispos)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view');
    }
};
