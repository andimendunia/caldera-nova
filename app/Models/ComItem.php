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

    public function parseContent()
    {
        $pattern = '/@(\w+)/';

        return preg_replace_callback($pattern, function($matches) {
            $username = $matches[1];
            $user = User::where('emp_id', $username)->first();
    
            if ($user) {
                return '<a href="#" class="text-neutral-400 dark:text-neutral-600">@' . $user->name . '</a>';
            }
    
            return '@' . $username; // If the user doesn't exist, return the original text
        }, e($this->content));
    }
}
