<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_area_id',
        'name',
        'year',
        'unit'
    ];
}
