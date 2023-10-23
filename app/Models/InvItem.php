<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InvItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'code',
        'price',
        'price_sec',
        'denom',
        'qty_main',
        'qty_used',
        'qty_rep',
        'qty_main_min',
        'qty_main_max',
        'is_active',
        'inv_loc_id',
        'inv_curr_id',
        'inv_uom_id',
        'inv_area_id',
        'photo',
    ];

    public function inv_uom(): BelongsTo
    {
        return $this->belongsTo(InvUom::class);
    }

    public function inv_area(): BelongsTo
    {
        return $this->belongsTo(InvArea::class);
    }

    public function inv_loc(): BelongsTo
    {
        return $this->belongsTo(InvLoc::class);
    }

    public function loc()
    {
        return $this->inv_loc->name ?? '';
    }

    public function inv_item_tags(): HasMany
    {
        return $this->hasMany(InvItemTag::class);
    }

    public function inv_tags(): BelongsToMany
    {
        return $this->belongsToMany(InvTag::class, 'inv_item_tags', 'inv_item_id', 'inv_tag_id');
    }

    public function tags_array()
    {
        $inv_tags = $this->inv_tags;
        return $inv_tags->pluck('name')->all();
    }

    public function tags()
    {
        $tags_array = $this->tags_array();
        return implode(', ', $tags_array);
    }

    public function updatePhoto($photo)
    {
        $path = storage_path('app/livewire-tmp/'.$photo);        
        $image = Image::make($path);
    
        // Resize the image to a maximum height of 600 pixels while maintaining aspect ratio
        $image->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        
        $image->encode('jpg', 70);

        // Set file name and save to disk and save filename to inv_item
        $id     = $this->id;
        $time   = Carbon::now()->format('YmdHis');
        $rand   = Str::random(5);
        $name   = $id.'_'.$time.'_'.$rand.'.jpg';

        Storage::put('/public/inv-items/'.$name, $image);

        return $this->update([
            'photo' => $name,
        ]);
    }
}
