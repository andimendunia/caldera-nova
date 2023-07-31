<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request) {

        $title = __('Beranda');
        $nav = $request['nav'];
        
        switch ($nav) {
            case 'search':
                $title = __('Cari');
                break;
            case 'circs':
                $title = __('Sirkulasi');
                break;
            case 'admin':
                $title = __('Administrasi');
                break;
        }
        $header = $title;
        
        return view('inventory.home', compact('title', 'header', 'nav'));
    }
}
