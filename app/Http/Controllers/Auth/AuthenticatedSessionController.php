<?php

namespace App\Http\Controllers\Auth;

use App\Models\Pref;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $data = '';
        $accountPref = Pref::where('user_id', $request->user()->id)->where('name', 'account')->first();
        if ($accountPref) {
            $data = json_decode($accountPref->data, true);
        } 
        $lang   = isset($data['lang']) ? $data['lang'] : 'id';
        $bg     = isset($data['bg']) ? $data['bg'] : 'light';
        $accent = isset($data['accent']) ? $data['accent'] : 'purple';

        session(['lang' => $lang]);
        session(['bg' => $bg]);
        session(['accent' => $accent]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
