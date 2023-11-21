<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvCirc extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_item_id',
        'qty',
        'qtype',
        'qty_before',
        'qty_after',
        'amount',
        'user_id',
        'assigner_id',
        'evaluator_id',
        'status',
        'remarks',
    ];

    public function inv_item(): BelongsTo
    {
        return $this->belongsTo(InvItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approve()
    {
        $item   = $this->inv_item;
        $qtype  = $this->qtype;

        // choose qty type
        switch ($qtype) {
            case 1:
                $qty_before = $item->qty_main;
                break;
            case 2:
                $qty_before = $item->qty_used;
                break;
            case 3:
                $qty_before = $item->qty_rep;
                break;
        } 

        $qty_after = $qty_before + $this->qty;

        if ($qty_after < 0) {
            return [
                'success' => false,
                'message' => __('Sirkulasi tak bisa disetujui karena qty barang akan menjadi negatif.'),
            ];

        } else {
            switch ($qtype) {
                case 1:
                    $item->qty_main = $qty_after;
                    break;
                case 2:
                    $item->qty_used = $qty_after;
                    break;
                case 3:
                    $item->qty_rep = $qty_after;
                    break;                  
            }
            $item->is_active = true;
            $item->save();
            $this->qty < 0 ? $item->updateFreq() : false;
            $this->status       = 1;
            $this->qty_before   = $qty_before;
            $this->qty_after    = $qty_after;
            $this->evaluator_id = Auth::user()->id;

            return [
                'success'       => true,
                'message'       => __('Sirkulasi disetujui.'),
                'qtype'         => $qtype,
                'qty_before'    => $qty_before,
                'qty_after'     => $qty_after,
            ];
        }

    }

    public function getDirIcon()
    {
        if ($this->qty < 0) {
            return 'fa-minus';
        } elseif ($this->qty > 0) {
            return 'fa-plus';
        } else {
            return 'fa-code-commit';
        }
    }

    public function getStatusIcon()
    {
        switch ($this->status) {
            case 0:
                return 'fa-hourglass-half';
                break;
            case 1:
                return 'fa-thumbs-up';
                break;
            case 2:
                return 'fa-thumbs-down';
                break;
        }
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 0:
                return __('Tertunda');
                break;
            case 1:
                return __('Disetujui');
                break;
            case 2:
                return __('Ditolak');
                break;
        }
    }

    public function getQtype()
    {
        switch ($this->qtype) {
            case 1:
                return __('Utama');
                break;
            case 2:
                return __('Bekas');
                break;
            case 3:
                return __('Diperbaiki');
                break;
        }
    }

    // protected function amount(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => Auth::user()->id == 1 ? $value : 0,
    //     );
    // }
}
