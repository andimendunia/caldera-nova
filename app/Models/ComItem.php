<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'mod',
        'mod_id',
        'user_id',
        'parent_id',
        'content',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
