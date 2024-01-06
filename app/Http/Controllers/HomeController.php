<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $greetings = array(
            __('Udah makan belum?'),
            __('Gimana kabarnya?'),
            __('Apa kabar?'),
            __('Selamat datang!'),
            __('Eh ketemu lagi!'),
            __('Ada yang bisa dibantu?'),
            __('Hai,'). ' ' . (Auth::user()->name ?? __('Tamu')).'!',
            __('Gimana gimana?'),
        );

        $time = Carbon::now()->format('Y-m-d H:i');
        $qago = Carbon::now()->subMinutes(30)->getTimestamp();
        $sessions = Session::where('last_activity', '>', $qago)->get();
        $user_ids = $sessions->pluck('user_id');
        $users = User::whereIn('id', $user_ids)->get();
        
        // Choose a random element from the $messages array
        $greeting = $greetings[array_rand($greetings)];
        return view('home', compact('greeting', 'time', 'users'));
    }
}
