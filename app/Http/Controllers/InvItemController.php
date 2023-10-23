<?php

namespace App\Http\Controllers;

use App\Models\InvCurr;
use App\Models\InvItem;
use Illuminate\Http\Request;

class InvItemController extends Controller
{
    public function show($id) {
        $prev = route('inventory', ['nav' => 'search']);

        $inv_item = InvItem::findOrFail($id);
        $title = $inv_item->name;

        return view('inventory.items.show', compact('title', 'prev', 'inv_item'));
    }

    public function edit($id) {
        $title = __('Edit').': '.'Nama barang';
        $prev = route('inventory.items.show', ['id' => $id]);
        $header = __('Edit barang');

        $invItem = $id;

        return view('inventory.items.edit', compact('title', 'prev', 'header', 'invItem'));
    }

    public function create(Request $request) {

        $title = __('Buat barang');
        $prev = route('inventory', ['nav' => 'admin']);
        $header = __('Buat barang');

        return view('inventory.items.create', compact('title', 'prev', 'header'));
    }
}
