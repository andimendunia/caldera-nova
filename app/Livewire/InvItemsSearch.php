<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class InvItemsSearch extends Component
{
    use WithPagination;

    #[Url]
    public $q;
    public $qwords;

    #[Url]
    public $status;
    #[Url]
    public $qty;
    #[Url]
    public $filter;

    #[Url]
    public $loc;
    #[Url]
    public $tags;
    public $tags_array;
    #[Url]
    public $without;

    #[Url]
    public $area_ids;

    #[Url]
    public $sort;
    #[Url]
    public $view;

    public $perPage = 24;

    public function render()
    {
        return view('livewire.inv-items-search');
    }
}
