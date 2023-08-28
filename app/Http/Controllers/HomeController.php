<?php

namespace App\Http\Controllers;

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
            __('Hai, ') . Auth::user()->name.'!',
            __('Gimana gimana?'),
        );
        
        // Choose a random element from the $messages array
        $greeting = $greetings[array_rand($greetings)];
        return view('home', compact('greeting'));
    }
}
