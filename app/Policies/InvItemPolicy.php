<?php

namespace App\Policies;

use App\Models\InvItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return (count($user->invAreaIds()) > 0 || $user->id === 1)
        ? Response::allow()
        : Response::deny( __('Kamu tak memiliki wewenang untuk melihat inventaris.') );
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InvItem $invItem): Response
    {
        return $user->authInvArea($invItem->inv_area_id)
        ? Response::allow()
        : Response::deny( __('Kamu tak memiliki wewenang untuk melihat barang ini.') );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return ($user->id == 2);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InvItem $invItem): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InvItem $invItem): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InvItem $invItem): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InvItem $invItem): bool
    {
        //
    }

    public function before(User $user, string $ability): bool|null
    {
        if ($user->id == 1) {
            return true;
        }
    
        return null;
    }
}
