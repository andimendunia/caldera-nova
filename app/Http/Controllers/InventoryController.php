<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request) {

        $title = __('Beranda');
        $nav = $request['nav'];
        $view = $request['view'];
        
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
        
        switch ($view) {
            case 'mass-circ':
                # code...
                break;
            case 'mass-update':
                # code...
                break;
            case 'manage-locs':
                # code...
                break;
            case 'manage-tags':
                # code...
                break;
            case 'manage-currs':
                # code...
                break;
            case 'manage-uoms':
                # code...
                break;
            
            default:
                return view('inventory.home', compact('title', 'header', 'nav', 'view'));
                break;
        }
        

    }
}
