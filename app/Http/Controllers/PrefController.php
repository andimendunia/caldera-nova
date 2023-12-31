<?php

namespace App\Http\Controllers;

use App\Models\Pref;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;

class PrefController extends Controller
{
    public function index(Request $request) {
        $nav = $request['nav'];
        $data = '';

        $accountPref = Pref::where('user_id', $request->user()->id)->where('name', 'account')->first();
        if ($accountPref) {
            $data = json_decode($accountPref->data, true);
        } 

        switch ($nav) {
            case 'theme':
                $bg = isset($data['bg']) ? $data['bg'] : 'auto';
                $accent = isset($data['accent']) ? $data['accent'] : 'purple';
                $mblur = $data['mblur'] ?? false;
                return view('prefs.theme', compact('bg', 'accent', 'mblur'));
                break;
            
            default:
                $lang = isset($data['lang']) ? $data['lang'] : 'id';
                $pua  = isset($data['pua']) ? $data['pua'] : '';

                return view('prefs.index', compact('lang', 'pua'));
                break;
        }        
    }

    public function updateLang(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updateLang', [
            'lang' => ['required', Rule::in(['id', 'en'])],
        ]);

        $pref = Pref::firstOrCreate(
            ['user_id' => $request->user()->id, 'name' => 'account'],
            ['data' => json_encode([])] // Create a new empty JSON object if the record doesn't exist
        );
        
        // Fetch the existing 'data' field
        $existingData = json_decode($pref->data, true);
        
        // Update the specific keys or add new keys if they don't exist
        $existingData['lang'] = $validated['lang']; // Update 'lang' key

        App::setLocale($validated['lang']);
        session()->put('lang', $validated['lang']);
        
        // Update the 'data' field with the modified JSON
        $pref->update(['data' => json_encode($existingData)]);
        

        return back()->with('status', 'lang-updated');
    }

    public function updateTheme(Request $request): RedirectResponse
    {
        $request['mblur'] = $request['mblur'] ?? false ? true : false;
        // dd($request);
        $validated = $request->validate([
            'bgm'       => ['nullable', 'string'],
            'bg'        => ['required', Rule::in(['auto', 'dark', 'light'])],
            'accent'    => ['required', Rule::in(['purple', 'green', 'pink', 'blue', 'teal', 'orange', 'grey', 'brown', 'yellow'])],
            'mblur'     => ['required', 'bool']
        ]);


         $pref = Pref::firstOrCreate(
            ['user_id' => $request->user()->id, 'name' => 'account'],
            ['data' => json_encode([])] // Create a new empty JSON object if the record doesn't exist
        );
        
        
        // Fetch the existing 'data' field
        $existingData = json_decode($pref->data, true);
        
        // update: change to collection
        // Update the specific keys or add new keys if they don't exist
        $existingData['bg']     = $validated['bg']; // Update 'lang' key
        $existingData['accent'] = $validated['accent']; // Update 'lang' key
        $existingData['mblur']  = $validated['mblur'];

        if($validated['bg'] == 'auto' && $validated['bgm'] == 'dark') {
            session(['bg' => 'dark']);
        } else {
            session(['bg' => $validated['bg']]);
        }
        session(['mblur' => $validated['mblur']]);
        session(['accent' => $validated['accent']]);
        // Update the 'data' field with the modified JSON
        $pref->update(['data' => json_encode($existingData)]);

        return back()->with('status', 'updated');
    }
}
