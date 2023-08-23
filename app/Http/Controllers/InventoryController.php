<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request) {

        $title = __('Beranda');
        $nav = $request['nav'];
        $view = $request['view'];
        $prev = '';
        
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
            case 'mass-circ':
                $title = __('Sirkulasi massal');
                $prev = route('inventory', ['nav' => 'admin']);
                break;
            case 'mass-circ':
                $title = __('Sirkulasi massal');
                $prev = route('inventory', ['nav' => 'admin']);
                break;
            case 'mass-update':
                $title = __('Perbarui massal');
                $prev = route('inventory', ['nav' => 'admin']);
                break;
            case 'manage-locs':
                $title = __('Kelola lokasi');
                $prev = route('inventory', ['nav' => 'admin']);
                break;
            case 'manage-tags':
                $title = __('Kelola tag');
                $prev = route('inventory', ['nav' => 'admin']);
                break;
            case 'manage-currs':
                $title = __('Kelola mata uang');
                $prev = route('inventory', ['nav' => 'admin', 'view' => 'global']);
                break;
            case 'manage-uoms':
                $title = __('Kelola UOM');
                $prev = route('inventory', ['nav' => 'admin', 'view' => 'global']);
                break;
        }
        $header = $title;
        
        return view('inventory.home', compact('title', 'prev', 'header', 'nav', 'view'));

    }
}
