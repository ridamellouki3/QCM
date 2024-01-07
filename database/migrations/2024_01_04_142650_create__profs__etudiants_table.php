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
        Schema::create('_profs__etudiants', function (Blueprint $table) {
           $table->id();
            $table->foreignId('professeur_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('etudiant_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_profs__etudiants');
    }
};
