<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $sportId = $request->input('sport_id');
        $kota = $request->input('kota');

        $authUser = Auth::user();

        // 1. Inisialisasi query utama & Eager Loading relasi 'sports' agar efisien
        $query = User::query()->where('id', '!=', $authUser->id ?? 0)->with('sports');

        // 2. Pencarian Pintar (Smart Search) lewat Input Teks
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('bio', 'like', "%{$keyword}%")
                  ->orWhereHas('sports', function ($relationQuery) use ($keyword) {
                      $relationQuery->where('nama_sport', 'like', "%{$keyword}%");
                  });
            });
        }

        // 3. Filter berdasarkan Dropdown Kategori Sport
        if (!empty($sportId)) {
            $query->whereHas('sports', function ($q) use ($sportId) {
                $q->where('sports.id', $sportId);
            });
        }

        // 4. Filter berdasarkan Dropdown Kota
        if (!empty($kota)) {
            $query->where('kota', 'like', "%{$kota}%");
        }

        // Eksekusi pencarian data user
        $users = $query->get();

        // 5. Hitung persentase kecocokan (% Match) untuk masing-masing user yang ditemukan
        if ($authUser) {
            $mySportIds = $authUser->sports()->pluck('user_sports');
            
            $users->each(function ($user) use ($mySportIds) {
                $shared = $user->sports->pluck('id')->intersect($mySportIds)->count();
                // Simpan nilai match ke dalam properti dinamis tiap user
                $user->match_percent = $mySportIds->count() > 0 ? min(99, 55 + $shared * 15) : 55;
            });
        }

        // Ambil data semua sport untuk isi pilihan dropdown di view
        $sports = Sport::all();

        // Return view dengan membawa data users dan sports yang sudah bersih dari eror
        return view('explore.index', compact('users', 'sports'));
    }

    public function show(User $user)
    {
        $authUser = Auth::user();
        $user->load('sports');
        $friendStatus = $authUser->friendStatusWith($user);
        $mySportIds = $authUser->sports()->pluck('sports.id');
        $shared = $user->sports->pluck('id')->intersect($mySportIds)->count();
        $matchPercent = $mySportIds->count() > 0 ? min(99, 55 + $shared * 15) : 55;

        return view('explore.show', compact('user', 'friendStatus', 'matchPercent'));
    }
}