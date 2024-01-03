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
        Schema::create('ins_acm_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rate_min');
            $table->unsignedInteger('rate_max');
            $table->unsignedInteger('rate_act');
            $table->datetime('dt_client');
            $table->foreignId('ins_acm_device_id')->constrained()->cascadeOnDelete();
            $table->datetime('dt_server');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ins_acm_metrics');
    }
};
