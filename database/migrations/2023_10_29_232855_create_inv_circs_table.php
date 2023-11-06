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
        Schema::create('inv_circs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inv_item_id')->constrained()->cascadeOnDelete();
            $table->integer('qty');
            $table->tinyInteger('qtype'); // 1: main, 2: used, 3: rep
            $table->integer('qty_before');
            $table->integer('qty_after');
            $table->decimal('amount');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigner_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('evaluator_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->tinyInteger('status'); // 0: pending, 1: approved, 2:rejected 3: expired
            $table->string('remarks');
            $table->timestamps();

            $table->index('inv_item_id');
            $table->index('user_id');
            $table->index('assigner_id');
            $table->index('evaluator_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_circs');
    }
};
