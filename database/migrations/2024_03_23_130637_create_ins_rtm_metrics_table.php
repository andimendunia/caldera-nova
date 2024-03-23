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
        Schema::create('ins_rtm_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('line');
            $table->foreignId('ins_rtm_recipes_id')->constrained()->cascadeOnDelete();
            $table->unsignedDecimal('left_act', 5, 2);
            $table->unsignedDecimal('right_act', 5, 2);
            $table->datetime('dt_client');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ins_rtm_metrics');
    }
};
