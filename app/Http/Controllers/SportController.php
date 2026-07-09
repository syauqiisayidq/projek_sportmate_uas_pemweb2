<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportController extends Controller
{
    public function pick()
    {
        $sports = Sport::orderBy('nama_sport')->get();
        $mySportIds = Auth::user()->sports()->pluck('sports.id')->toArray();

        return view('sports.pick', compact('sports', 'mySportIds'));
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'sports' => ['required', 'array', 'min:1'],
            'sports.*' => ['exists:sports,id'],
            'jadwal' => ['nullable', 'string', 'max:255'],
        ]);

        $sync = [];
        foreach ($data['sports'] as $sportId) {
            $sync[$sportId] = ['jadwal' => $data['jadwal'] ?? null];
        }

        Auth::user()->sports()->sync($sync);

        return redirect()->route('dashboard')->with('status', 'Olahraga favorit berhasil disimpan!');
    }
}
