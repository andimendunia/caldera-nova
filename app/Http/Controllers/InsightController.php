<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InsightController extends Controller
{
    public function index(Request $request) {

        // Gate::authorize('viewAny', InvItem::class);

        $prev = '';
        $navs = false;
        $nav = $request['nav'];
        $view = $request['view'];
                
        switch ($nav) {

            case 'acm':
                $title = __('Assembly Conveyor Monitoring');
                $prev = route('insight');
                $navs = true;
                break;

            case 'rtm':
                $title = __('Rubber Thickness Monitoring');
                $prev = route('insight');
                $navs = true;
                break;

            default:
                $title = __('Wawasan');
                $navs = true;
        }

        $header = $title;
        return view('insight.index', compact('title', 'prev', 'header', 'nav', 'navs', 'view'));

    }
}
