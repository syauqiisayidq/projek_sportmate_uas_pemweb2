<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalEvents = Event::count();
        $totalFriendRequests = DB::table('friends')->count();
        $activeUsers = User::where('role', 'user')->whereHas('eventParticipations')->count();

        $eventTerbaru = Event::with('sport')->latest()->limit(3)->get();
        $penggunaTerbaru = User::where('role', 'user')->latest()->limit(5)->get();

        $aktivitasMingguan = collect(range(6, 0))->map(function ($i) {
            $date = now()->subDays($i);

            return [
                'label' => $date->translatedFormat('D'),
                'total' => Event::whereDate('created_at', $date->toDateString())->count()
                    + DB::table('event_participants')->whereDate('created_at', $date->toDateString())->count(),
            ];
        });

        return view('admin.dashboard', compact(
            'totalUsers', 'totalEvents', 'totalFriendRequests', 'activeUsers',
            'eventTerbaru', 'penggunaTerbaru', 'aktivitasMingguan'
        ));
    }
}
