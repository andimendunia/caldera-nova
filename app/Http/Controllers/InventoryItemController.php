<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function show($id) {
        $title = 'Nama barang';
        $prev = route('inventory', ['nav' => 'search']);

        $invItem = $id;

        return view('inventory.items.show', compact('title', 'prev', 'invItem',));
    }

    public function edit($id) {
        $title = __('Edit').': '.'Nama barang';
        $prev = route('inventory.items.show', ['id' => $id]);
        $header = __('Edit barang');

        $invItem = $id;

        return view('inventory.items.edit', compact('title', 'prev', 'header', 'invItem'));
    }
}
