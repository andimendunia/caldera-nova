<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class InvItemsSearch extends Component
{
    use WithPagination;

    public $q;
    public $qwords;

    public $status;
    public $qty;
    public $filter;

    public $loc;
    public $tags;
    public $tags_array;
    public $without;

    public $area_ids;

    public $sort;
    public $view;

    public $perPage = 24;

    public function render()
    {
        return view('livewire.inv-items-search');
    }
}
