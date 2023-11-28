<?php

namespace App\Http\Controllers;

use App\Models\InvUom;
use App\Models\InvCirc;
use App\Models\InvItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class InvCircController extends Controller
{
    public function create(Request $request)
    {
        // trim all strings
        $requestData = $request->all();
        array_walk_recursive($requestData, function (&$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        });

        $request->merge($requestData);

        switch ($request['qtype']) {
            case 'main':
                $request['qtype'] = 1;
                break;
            case 'used':
                $request['qtype'] = 2;
                break;
            case 'rep':
                $request['qtype'] = 3;
                break;
        }

        $request['uom'] = strtoupper($request['uom']);
        $request['code'] = strtoupper($request['code']);
     
        $validator = Validator::make($request->all(), [
            'area_id'   => 'required|integer|exists:App\Models\InvArea,id',
            'code'     => 'required|alpha_dash|size:11',
            'name'     => 'required|min:1|max:128',
            'desc'     => 'required|min:1|max:256',
            'uom'      => 'required|min:1|max:5',
            'qty'      => 'required|integer|min:-99999|max:99999',
            'qtype'    => 'required|integer|min:1|max:3',
            'remarks'  => 'required|string'
        ], [
            'qtype.integer' => __('Kolom jenis qty hanya bisa diisi oleh \'main\', \'used\', atau \'rep\'.'),
        ]);

        if ($validator->fails()) {

            $response = [
                'status'    => [
                    'success' => false,
                    'code'    => 'ER-VF',
                    'msg'     => $validator->errors(),
                ]
            ];

        } else {

            $response = [
                'status'    => [
                    'success' => false,
                    'code'    => 'ERR-AF',
                    'msg'     => [ __('Kamu tidak memiliki wewenang.') ],
                ]
            ];

            $item = InvItem::firstOrNew([
                'inv_area_id' => $request['area_id'],
                'code' => $request['code']
            ],[
                'name'      => $request['name'],
                'desc'      => $request['desc'],
                'qty_main'  => 0,
                'qty_used'  => 0,
                'qty_rep'   => 0,
                'freq'      => 0,
                'qty_main_min'  => 0,
                'qty_main_max'  => 0,
                'denom'     => 1,
                'is_active' => false,
            ]);

            $circ = new InvCirc([
                'qty'           => $request['qty'],
                'qtype'         => $request['qtype'],
                'remarks'       => $request['remarks'],

                'qty_before'    => 0,
                'qty_after'     => 0,
                'amount'        => 0,
                'user_id'       => Auth::user()->id,
                'status'        => 0,
            ]);
            $circ->inv_item()->associate($item);

            if (Gate::allows('updateOrCreate', $item) && Gate::allows('create', $circ)) {

                if ($item->id ?? false) {
                    if ($item->inv_uom->name == $request['uom']) {
                        $response = [
                            'status'    => [
                                'success' => true,
                                'code'    => 'OK-U',
                                'msg'     => [ __('Sirkulasi berhasil dibuat untuk barang yang sudah ada.') ],
                            ]
                        ];
                        $circ->inv_item_id = $item->id;
                        $circ->save();
                    } else {
                        $response = [
                            'status'    => [
                                'success' => false,
                                'code'    => 'ERR-D',
                                'msg'     => [ __('UOM sirkulasi dan barang berbeda.') ],
                            ]
                        ];
                    }
                } else {
                    $response = [
                        'status'    => [
                            'success' => true,
                            'code'    => 'OK-N',
                            'msg'     => [ __('Sirkulasi berhasil dibuat untuk barang yang baru.') ],
                        ]
                    ];
                    $uom = InvUom::firstOrCreate([
                        'name' => $request['uom']
                    ]);
                    $item->inv_uom_id = $uom->id;
                    $item->save();
                    $circ->inv_item_id = $item->id;
                    $circ->save();
                }
            }



            
        }

        // Return a response, e.g., with the created cat fact
        return response()->json($response, 201);
    }
}
