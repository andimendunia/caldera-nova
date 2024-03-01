<?php

namespace App\Http\Controllers;

use App\Models\KpiItem;
use App\Models\KpiScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KpiScoreController extends Controller
{
    public function show($id)
    {
        Gate::authorize('viewAny', KpiItem::class);

        $prev = route('kpi', [ 'nav' => 'submission' ]);
        $navs = true;
        $title = 'Title placeholder';

        $score = KpiScore::find($id);
        $item = $score->kpi_item;

        return view('kpi.scores.show', compact('title', 'prev', 'navs', 'item'));
    }
}
