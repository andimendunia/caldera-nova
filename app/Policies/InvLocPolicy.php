<?php

namespace App\Policies;

use App\Models\InvLoc;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvLocPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function manage(User $user, InvLoc $invLoc): Response
    {
        $auth = $user->inv_auths->where('inv_area_id', $invLoc->inv_area_id)->first();
        $actions = json_decode($auth->actions ?? '{}', true);
        return in_array('manage-loc', $actions)
        ? Response::allow()
        : Response::deny( __('Kamu tak memiliki wewenang untuk mengelola lokasi di area') . ' ' . $invLoc->inv_area->name );
    }

    public function before(User $user, string $ability): bool|null
    {
        return $user->id == 1 ? true : null;
    }

}
