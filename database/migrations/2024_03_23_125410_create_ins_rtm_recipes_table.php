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
            $table->unsignedDecimal('thick_std_min', 5, 2);
            $table->unsignedDecimal('thick_std_max', 5, 2);
            $table->unsignedDecimal('thick_sl_min', 5, 2)->nullable();
            $table->unsignedDecimal('thick_sl_max', 5, 2)->nullable();
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
