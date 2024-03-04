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

        $months = [
            1 => __('Januari'),
            2 => __('Februari'),
            3 => __('Maret'),
            4 => __('April'),
            5 => __('Mei'),
            6 => __('Juni'),
            7 => __('Juli'),
            8 => __('Agustus'),
            9 => __('September'),
            10 => __('Oktober'),
            11 => __('November'),
            12 => __('Desember'),
        ];

        $score = KpiScore::find($id);
        $item = $score->kpi_item;
        $month_name = $months[$score->month];
        $title = $item->name . ' ' . '(' . $month_name . ' ' . $item->year . ')';

        return view('kpi.scores.show', compact('title', 'prev', 'navs', 'score', 'item', 'month_name'));
    }
}
