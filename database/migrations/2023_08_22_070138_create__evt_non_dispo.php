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
        Schema::create('evt_non_dispos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evt_id');
            $table->foreign('evt_id')->references('id')->on('evenements');
            $table->timestamps();
        });

        DB::statement('CREATE VIEW v_evt_dispos AS SELECT * FROM evenements WHERE id NOT IN (SELECT evt_id FROM evt_non_dispos)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_evt_non_dispo');
    }
};
