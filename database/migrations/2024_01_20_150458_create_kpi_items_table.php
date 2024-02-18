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
        Schema::create('kpi_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_sec_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->smallInteger('year'); // max 32767
            $table->string('unit');
            $table->tinyInteger('order'); // max 255
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_items');
    }
};
