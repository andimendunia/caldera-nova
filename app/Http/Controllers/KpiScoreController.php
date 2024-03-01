<?php

namespace App\Http\Controllers;

use App\Models\KpiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KpiScoreController extends Controller
{
    public function show()
    {
        Gate::authorize('viewAny', KpiItem::class);

        $prev = route('kpi', [ 'nav' => 'submission' ]);
        $navs = true;
        $header = '';
        $title = '';

        return view('kpi.scores.show', compact('title', 'prev', 'header', 'navs'));
    }
}
