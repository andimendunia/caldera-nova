<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsAcmMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_min',
        'rate_max',
        'rate_act',
        'dt_client',
        'ins_acm_device_id',
    ];

    protected $casts = [
        'dt_client' => 'datetime',
    ];
}
