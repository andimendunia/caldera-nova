<?php

namespace App\Http\Controllers;

use App\Models\InvCurr;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class InvCurrController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $request['name'] = strtoupper($request->name);

        $request->validateWithBag('currCreation', [
            'name' => ['required', 'alpha:ascii', 'unique:'.InvCurr::class, 'size:3'],
            'rate' => ['numeric']
        ]);

        $curr = InvCurr::create([
            'name' => $request->name,
            'rate' => $request->rate,
        ]);

        return Redirect::route('inventory', ['nav' => 'manage-currs'])->with('success', __('Mata uang ditambahkan'));
    }
}
