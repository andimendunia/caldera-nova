<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inv_currs', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('rate');

            $table->timestamps();
        });

        DB::table('inv_currs')->insert([
            ['name' => 'USD','rate' => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_currs');
    }
};
