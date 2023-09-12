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
            $table->timestamps();
            //name
            //desc
            //code
            //price
            //price_sec
            //inv_curr_id 
            //inv_uom_id
            //inv_loc_id
            //inv_area_id
            //qty_main
            //qty_used
            //qty_rep
            //qty_main_min
            //qty_main_max
            //loc_updated_at
            //photo

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

            // table: inv_currs
            //name
            //rate

            // table: inv_area
            // name: 
            
            // table: inv_locs, inv_tags
            //name
            //inv_area_id

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
