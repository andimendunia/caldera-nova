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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emp_id')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->dateTime('seen_at')->nullable();
            $table->boolean('is_active');
            $table->rememberToken();
            $table->timestamps();

            $table->index('emp_id');

        });
        
        DB::table('users')->insert([
            [
                'name'      => 'System',
                'emp_id'    => 'SUPERUSER',
                'password'  => '$2y$10$HR/Et5LBPfAW2frIq/u1zOXTXojDSmJM/cJgKnIawOlCrn/x2Ws3W',
                'is_active' => 1
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
