<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsRtmMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'thickness_min',
        'thickness_max',
        'thickness_act',
        'dt_client',
        'ins_acm_device_id',
    ];

    protected $casts = [
        'dt_client' => 'datetime',
    ];
}
