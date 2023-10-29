<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvCirc extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'qtype',
        'qty_before',
        'qty_after',
        'amount',
        'user_id',
        'assigner_id',
        'evaluator_id',
        'status',
        'remarks',
    ];
}
