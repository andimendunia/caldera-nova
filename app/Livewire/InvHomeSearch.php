<?php

namespace App\Livewire;

use App\Models\InvArea;
use App\Models\InvItem;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;

class InvHomeSearch extends Component
{
    public $q;
    public $qwords = [];
    public $area_ids = [];
    public $route;

    public function mount()
    {
        // update: get from pref
        $this->area_ids = InvArea::all()->pluck('id')->toArray();
        $this->route = route('inventory', ['nav' => 'search']);
    }

    public function render()
    {
        return view('livewire.inv-home-search');
    }

    public function go()
    {
        $keyword = trim($this->q);
        if ($keyword) {
            return redirect(route('inventory', ['nav' => 'search', 'q' => $keyword]));
        }         
    }

    public function updatedQ()
    {
        $keyword = trim($this->q);
        if ($keyword) {
        // Fetch items that contain the keyword in their name column
        $inv_items = InvItem::select('name', 'desc', 'code')->whereIn('inv_area_id', $this->area_ids)
        ->where(function (Builder $query) use ($keyword) {
            $query->orWhere('name', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('desc', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('code', 'LIKE', '%'.$keyword.'%');
        })->limit(100)->get()->toArray();
        $inv_items = Arr::flatten($inv_items);
        $suggestions = [];

        // Extract individual words from retrieved names
        foreach ($inv_items as $name) {
            $words = explode(' ', strtolower($name));
            foreach ($words as $word) {
                // Check if the word starts with the keyword
                if (stripos($word, $keyword) !== false) {
                    $suggestions[] = $word;
                }
            }
        }
        // Filter and return unique suggestions
        $suggestions = array_values(array_unique($suggestions));
        sort($suggestions);
        $this->qwords = $suggestions;
        }
    }
}
