<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'com_item_id',
        'name',
        'client_name',
        'is_image'
    ];
}
