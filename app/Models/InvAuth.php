<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvAuth extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'inv_area_id',
        'actions'
    ];
}
