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
        'freq',
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
        if($photo) {
            if ($this->photo != $photo) {
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
        } else {
            return $this->update([
                'photo' => null,
            ]);
        }


    }

    public function updateLoc($loc)
    {
        $loc = trim(strtoupper($loc));
        if ($loc) {
            $inv_loc = InvLoc::firstOrCreate([
                'inv_area_id'   => $this->inv_area_id,
                'name'          => $loc,
            ]);
            return $this->update([
                'inv_loc_id' => $inv_loc->id,
            ]);
        } else {
            return $this->update([
                'inv_loc_id' => null,
            ]);

        }
    }

    public function updateTags($tags)
    {
        $tags = array_map('strtolower', $tags);
        $tags = array_map('trim', $tags);
        $tags = array_diff($tags, ['']);

        $tag_ids = [];
        foreach ($tags as $tag) {
            $tag_ids[] = InvTag::firstOrCreate([
                'inv_area_id'   => $this->inv_area_id,
                'name'          => $tag,
            ])->id;
        }   

        InvItemTag::where('inv_item_id', $this->id)->delete();

        foreach ($tag_ids as $tag_id) {
            InvItemtag::firstOrCreate([
                'inv_item_id'   => $this->id,
                'inv_tag_id'    => $tag_id
            ]);
        }
    }

    public function updateFreq()
    {
        // Fetch the required inv_circs from the table
        $inv_circs = InvCirc::where('inv_item_id', $this->id)
        ->where('qty', '<', 0)
        ->orderBy('created_at', 'asc')
        ->limit(100)
        ->get();

        if($inv_circs->count()) 
        {
            // Extract the date values and quantities
            $dates = $inv_circs->pluck('created_at')->toArray();
            $qtys = $inv_circs->pluck('qty')->toArray();

            // Calculate the difference in days between the maximum and minimum date using Carbon
            $startDate = Carbon::parse($dates[0]);
            $endDate = Carbon::parse(end($dates));
            $diffInDays = $endDate->diffInDays($startDate);

            // Omitting the first qty from the most minimum date
            $absQtys = array_map('abs', $qtys);
            $absQtys[0] = 0;

            // Calculate the absolute sum of qty (excluding the first qty)
            $absoluteSum = array_sum($absQtys);

            // Calculate the final result
            if ($absoluteSum != 0) {
                $output = $diffInDays / $absoluteSum;
                $this->update([
                    'freq' => round($output, 2)
                ]);
            }
        }
    }
}
