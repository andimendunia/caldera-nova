<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'code',
        'price',
        'price_sec',
        'denom',
        'qty_main',
        'qty_used',
        'qty_rep',
        'qty_main_min',
        'qty_main_max',
        'is_active',
        'inv_loc_id',
        'inv_curr_id',
        'inv_uom_id',
        'inv_area_id',
        'photo',
    ];
}
