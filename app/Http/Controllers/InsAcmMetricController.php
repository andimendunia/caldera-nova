<?php

namespace App\Http\Controllers;

use App\Models\InsAcmMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InsAcmMetricController extends Controller
{    
    public function store(Request $request): int
    {
        $count      = (int) 0;
        $metrics    = (array) $request['data'];

        foreach ($metrics as $metric) {

            $validator = Validator::make( $metric,
                [
                    'rate_min'  => 'required|integer|min:0|max:100',
                    'rate_max'  => 'required|integer|min:0|max:100',
                    'rate_act'  => 'required|integer|min:0|max:100',
                    'dt_client' => 'required|date',
                    'line'      => 'required|string|min:1|max:4',
                ]
            );
    
            if ($validator->passes()) {
                $count++;
                $x = new InsAcmMetric();
                $x->rate_min            = $metric['rate_min'];
                $x->rate_max            = $metric['rate_max'];
                $x->rate_act            = $metric['rate_act'];
                $x->dt_client           = $metric['dt_client'];
                $x->line                = $metric['line'];
                $x->save();
            }

        }

        return $count;
    }
}
