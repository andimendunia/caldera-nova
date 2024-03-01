<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpiScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kpi_item_id',
        'month',
        'target',
        'actual',
        'is_submitted'
    ];

    public function kpi_item(): BelongsTo
    {
        return $this->belongsTo(KpiItem::class);
    }
    
}
