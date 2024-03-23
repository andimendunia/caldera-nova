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
        Schema::create('ins_rtm_recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('og_rs');
            $table->unsignedDecimal('min_std', 5, 2);
            $table->unsignedDecimal('max_std', 5, 2);
            $table->unsignedDecimal('min_sl', 5, 2);
            $table->unsignedDecimal('max_sl', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ins_rtm_recipes');
    }
};
