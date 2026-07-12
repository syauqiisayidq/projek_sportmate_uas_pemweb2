<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $upcomingEvents = Event::with(['sport', 'creator'])
        ->where('status', 'upcoming')
        ->where('tanggal', '>=', now()->toDateString())
        ->orderBy('tanggal')
        ->orderBy('jam')
        ->take(3) // tampilkan 3 event saja
        ->get();

        $mySportIds = $user->sports()->pluck('sports.id');

        $rekomendasi = User::where('id', '!=', $user->id)
            ->whereHas('sports', function ($q) use ($mySportIds) {
                $q->whereIn('sports.id', $mySportIds);
            })
            ->where('kota', $user->kota)
            ->with('sports')
            ->limit(5)
            ->get()
            ->map(function ($u) use ($user, $mySportIds) {
                $shared = $u->sports->pluck('id')->intersect($mySportIds)->count();
                $u->match_percent = $mySportIds->count() > 0 ? min(99, 60 + $shared * 15) : 60;

                return $u;
            });

        $todayEvents = Event::with('sport')
            ->whereHas('joinedUsers', fn ($q) => $q->where('users.id', $user->id))
            ->whereDate('tanggal', now()->toDateString())
            ->get();

        $stats = [
            'teman' => $user->friends()->count(),
            'event' => $user->joinedEvents()->count(),
            'aktivitas' => $user->eventParticipations()->count(),
        ];

        
        return view('dashboard', compact('user','upcomingEvents','rekomendasi','todayEvents','stats'));
    }
}
