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
        Schema::create('prefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->json('data');
            $table->timestamps();

            $table->unique(['user_id', 'name']);
            $table->index('user_id');

        });

        // example name: inv-search
        // { 
        //    "q"           : "baut",
        //    "status"      : "active|inactive|both",
        //    "qty"         : "total|main|used|rep",
        //    "filter"      : "false"
        //    etc...
        // }

        // example name: inv-circs
        // { 
        //    "q"           : "baut",
        //    etc...
        // }

        // example name: inv-tags
        // ['tag-1', 'tag-2']
        // 

        // example name: inv-locs
        // ['A2-5', 'A2-8']
        // 

        // example name: account
        // { 
        //    "lang"          : "en",
        //    "theme-bg"      : "auto|light|dark",
        //    "theme-color"   : "green|teal|orange",
        //    "pw-updated-at" : "2023-11-06"
        //}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefs');
    }
};
