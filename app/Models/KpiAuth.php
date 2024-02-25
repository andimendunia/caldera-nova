<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpiAuth extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kpi_area_id',
        'actions'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kpi_area(): BelongsTo
    {
        return $this->belongsTo(KpiArea::class);
    }

    public function countActions()
    {
        $actions = json_decode($this->actions ?? '{}', true);
        return count($actions);
    }
}
