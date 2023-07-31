<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function show($id) {
        $title = 'Nama barang';
        $prev = route('inventory', ['nav' => 'search']);
        $nav = 'search';

        $invItem = $id;

        return view('inventory.items.show', compact('title', 'prev', 'invItem', 'nav'));
    }
}
