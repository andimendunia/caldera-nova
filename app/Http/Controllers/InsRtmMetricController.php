<?php

namespace App\Http\Controllers;

use App\Models\InsRtmMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InsRtmMetricController extends Controller
{
    public function store(Request $request): int
    {
        $count      = (int) 0;
        $metrics    = (array) $request['data'];

        foreach ($metrics as $metric) {

            $validator = Validator::make( $metric,
                [
                    'thickness_min'  => 'required|integer|min:0|max:100',
                    'thickness_max'  => 'required|integer|min:0|max:100',
                    'thickness_act'  => 'required|integer|min:0|max:100',
                    'dt_client' => 'required|date',
                    'line'      => 'required|string|min:1|max:4',
                ]
            );
    
            if ($validator->passes()) {
                $count++;
                $x = new InsRtmMetric();
                $x->thickness_min            = $metric['thickness_min'];
                $x->thickness_max            = $metric['thickness_max'];
                $x->thickness_act            = $metric['thickness_act'];
                $x->dt_client           = $metric['dt_client'];
                $x->line                = $metric['line'];
                $x->save();
            }

        }

        return $count;
    }
}
