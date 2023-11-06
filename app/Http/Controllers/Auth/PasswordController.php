<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Pref;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $pref = Pref::firstOrCreate(
            ['user_id' => $request->user()->id, 'name' => 'account'],
            ['data' => json_encode([])] // Create a new empty JSON object if the record doesn't exist
        );
        
        // Fetch the existing 'data' field
        $existingData = json_decode($pref->data, true);
        
        // Update the specific keys or add new keys if they don't exist
        $existingData['pua'] = Carbon::now()->format('Y-m-d H:i');
        
        // Update the 'data' field with the modified JSON
        $pref->update(['data' => json_encode($existingData)]);

        return back()->with('status', 'password-updated');
    }
}
