<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inv_area_id'
    ];
}
