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
        Schema::create('com_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('com_item_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->boolean('is_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('com_files');
    }
};
