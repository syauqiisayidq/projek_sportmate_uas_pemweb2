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
        $user = Auth::user();
        $mySportIds = $user->sports()->pluck('sports.id');

        $query = User::with('sports')
        ->where('role', 'user')
        ->where('id', '!=', $user->id);

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%'.$request->q.'%');
        }

        if ($request->filled('sport_id')) {
            $sportId = $request->sport_id;
            $query->whereHas('sports', fn ($q) => $q->where('sports.id', $sportId));
        }

        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%'.$request->kota.'%');
        }

        $users = $query->get()->map(function ($u) use ($mySportIds, $user) {
            $shared = $u->sports->pluck('id')->intersect($mySportIds)->count();
            $u->match_percent = $mySportIds->count() > 0 ? min(99, 55 + $shared * 15) : 55;
            $u->friend_status = $user->friendStatusWith($u);

            return $u;
        })->sortByDesc('match_percent')->values();

        $sports = Sport::orderBy('nama_sport')->get();

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
