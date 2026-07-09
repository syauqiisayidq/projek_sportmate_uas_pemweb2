<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;

class AdminSportController extends Controller
{
    public function index()
    {
        $sports = Sport::withCount('users')->orderBy('nama_sport')->get();

        return view('admin.sports.index', compact('sports'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_sport' => ['required', 'string', 'max:255', 'unique:sports,nama_sport'],
        ]);

        Sport::create($data);

        return back()->with('status', 'Olahraga berhasil ditambahkan.');
    }

    public function update(Request $request, Sport $sport)
    {
        $data = $request->validate([
            'nama_sport' => ['required', 'string', 'max:255', 'unique:sports,nama_sport,'.$sport->id],
        ]);

        $sport->update($data);

        return back()->with('status', 'Olahraga berhasil diperbarui.');
    }

    public function destroy(Sport $sport)
    {
        $sport->delete();

        return back()->with('status', 'Olahraga berhasil dihapus.');
    }
}
