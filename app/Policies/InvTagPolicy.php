<?php

namespace App\Policies;

use App\Models\InvTag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvTagPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function manage(User $user, InvTag $invTag): Response
    {
        $auth = $user->inv_auths->where('inv_area_id', $invTag->inv_area_id)->first();
        $actions = json_decode($auth->actions ?? '{}', true);
        return in_array('manage-loc', $actions)
        ? Response::allow()
        : Response::deny( __('Kamu tak memiliki wewenang untuk mengelola tag di area') . ' ' . $invTag->inv_area->name );

    }

}
