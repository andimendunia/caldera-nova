<?php

namespace App\Http\Controllers;

use App\Models\InvCurr;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request) {

        $prev = '';
        $navs = false;
        $nav = $request['nav'];
        $view = $request['view'];
                
        switch ($nav) {
            case 'search':
                $title = __('Cari');
                $navs = true;
                break;
            case 'circs':
                $title = __('Sirkulasi');
                $navs = true;
                break;
            case 'admin':
                $title = __('Administrasi');
                $navs = true;
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
            case 'manage-areas':
                $title = __('Kelola area');
                $prev = route('inventory', ['nav' => 'admin', 'view' => 'global']);
                break;
            case 'manage-currs':
                $title = __('Kelola mata uang');
                $prev = route('inventory', ['nav' => 'admin', 'view' => 'global']);
                break;
            case 'manage-uoms':
                $title = __('Kelola UOM');
                $prev = route('inventory', ['nav' => 'admin', 'view' => 'global']);
                break;
            default:
                $title = __('Beranda');
                $navs = true;
        }

        $header = $title;
        return view('inventory.index', compact('title', 'prev', 'header', 'nav', 'navs', 'view'));

    }
}
