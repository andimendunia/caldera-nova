<?php

namespace App\Http\Controllers;

use App\Models\InvCirc;
use Illuminate\Http\Request;

class InvCircController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'fact' => 'required|string',
        //     // Add validation rules for other fields if needed
        // ]);

        // Create a new cat fact
        // $inv_circ = InvCirc::create([
        //     'fact' => $request->input('fact'),
        //     // Set other fields accordingly
        // ]);

        // Succes code: U by updating items, N by creating items
        // error code: I invalid format, D different UOM

        $characters = array('U', 'N', 'I', 'D');

        $response = [
            'status'    => [
                'success' => (bool) rand(0, 1),
                'code'    => $characters[mt_rand(0, count($characters) - 1)],
                'msg'     => 'Long message explaining if theres something wrong',
            ]
        ];

        // Return a response, e.g., with the created cat fact
        return response()->json($response, 201);
    }
}
