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
        Schema::create('matches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('competition_id');
            $table->uuid('home_team_id');
            $table->uuid('away_team_id');
            $table->unsignedTinyInteger('status_id')->default(1);
            $table->unsignedBigInteger('match_time');
            $table->json('home_scores')->nullable();
            $table->json('away_scores')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
