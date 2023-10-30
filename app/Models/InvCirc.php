<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvCirc extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_item_id',
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

    public function inv_item(): BelongsTo
    {
        return $this->belongsTo(InvItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
