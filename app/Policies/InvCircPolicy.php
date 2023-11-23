<?php

namespace App\Policies;

use App\Models\InvCirc;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvCircPolicy
{

    public function eval(User $user, InvCirc $invCirc): Response
    {
        $auth = $user->inv_auths->where('inv_area_id', $invCirc->inv_item->inv_area_id)->first();
        $actions = json_decode($auth->actions ?? '{}', true);
        return in_array('circ-eval', $actions)
        ? Response::allow()
        : Response::deny( __('Kamu tak memiliki wewenang untuk mengevaluasi sirkulasi') );
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, InvCirc $invCirc): Response
    {
        $auth = $user->inv_auths->where('inv_area_id', $invCirc->inv_item->inv_area_id)->first();
        $actions = json_decode($auth->actions ?? '{}', true);
        return in_array('circ-create', $actions)
        ? Response::allow()
        : Response::deny( __('Kamu tak memiliki wewenang untuk membuat sirkulasi di') . ' ' . $invCirc->inv_item->inv_area->name) ;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InvCirc $invCirc): Response
    {
        return $user->id === $invCirc->user_id
        ? Response::allow()
        : Response::deny( __('Kamu tak bisa mengedit sirkulasi akun lain') );
    }

    public function before(User $user, string $ability): bool|null
    {
        return $user->id == 1 ? true : null;
    }

}
