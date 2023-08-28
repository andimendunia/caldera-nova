<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferencesController extends Controller
{
    public function index(Request $request) {
        $nav = $request['nav'];
        switch ($nav) {
            case 'theme':
                return view('preferences.theme');
                break;
            
            default:
                return view('preferences.index');
                break;
        }        
    }
}
