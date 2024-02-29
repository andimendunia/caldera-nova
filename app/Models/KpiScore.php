<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
