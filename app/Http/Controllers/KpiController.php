<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KpiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class KpiController extends Controller
{
    public function index(Request $request) {

        Gate::authorize('viewAny', KpiItem::class);

        $prev = '';
        $navs = false;
        $nav = $request['nav'];
        $view = $request['view'];
                
        switch ($nav) {

            case 'overview':
                $title = __('Ikhtisar');
                $navs = true;
                break;

            case 'submission':
                $title = __('Penyerahan');
                $navs = true;
                break;

            case 'admin':
                $title = __('Administrasi');
                $navs = true;
                // $user = User::find(Auth::user()->id);
                break;

            case 'manage-items':
                $title = __('Kelola KPI');
                $prev = route('kpi', ['nav' => 'admin']);
                break;

            case 'manage-auth':
                $title = __('Kelola wewenang');
                $prev = route('kpi', ['nav' => 'admin']);
                break;

            case 'manage-areas':
                $title = __('Kelola area');
                $prev = route('kpi', ['nav' => 'admin']);
                break;

            default:
                $title = __('Laporan KPI');
                $navs = true;
        }

        $header = $title;
        return view('kpi.index', compact('title', 'prev', 'header', 'nav', 'navs', 'view'));

    }
}
