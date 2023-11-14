<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
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

        if ($qtype) {
            $qty_after = $qty_before + $this->qty;

            if ($qty_after < 0) {
                return ['error', __('Sirkulasi tak bisa disetujui (Qty barang negatif)')];

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
                $this->update([
                    'status'        => 1,
                    'qty_before'    => $qty_before,
                    'qty_after'     => $qty_after,
                    'evaluator_id'  => Auth::user()->id
                ]);
                $item->save();
                return ['success', __('Sirkulasi disetujui'), $qtype, $qty_after];
            }
        } else {
            return ['error', 'Qtype is not defined'];
        }

    }

    public function getIcon()
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
}
