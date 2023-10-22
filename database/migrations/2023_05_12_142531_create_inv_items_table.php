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
        Schema::create('inv_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->string('code')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('price_sec')->nullable();
            $table->foreignId('inv_curr_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('inv_uom_id')->constrained()->restrictOnDelete();
            $table->foreignId('inv_loc_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('inv_area_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('qty_main');
            $table->unsignedInteger('qty_used');
            $table->unsignedInteger('qty_rep');
            $table->unsignedInteger('qty_main_min');
            $table->unsignedInteger('qty_main_max');
            $table->unsignedInteger('denom');
            $table->dateTime('loc_updated_at')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active');
            $table->timestamps();

            $table->index('code');
            $table->index('inv_curr_id');
            $table->index('inv_uom_id');
            $table->index('inv_loc_id');
            $table->index('inv_area_id');

            // table: inv_circs
            //qty
            //qty_type
            //qty_before
            //qty_after
            //amount
            //user_id
            //assigner_id
            //evaluator_id
            //status 1 approved, 2 rejected, null pending
            //remarks

            // table: inv_item_tags
            //inv_item_id
            //inv_tag_id

            // table: inv_auth
            //user_id
            //inv_area_id
            //inv_role_id

            // table: inv_roles
            //name
            //value: []

            // table: prefs
            //user_id:
            //name: theme//lang//inv_search//inv_circs//inv_print
            //value:
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_items');
    }
};
