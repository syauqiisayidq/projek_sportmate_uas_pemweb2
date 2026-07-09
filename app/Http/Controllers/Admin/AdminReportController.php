<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        $sportPopuler = Sport::withCount('users')->orderByDesc('users_count')->limit(5)->get();
        $kotaTerbanyak = User::where('role', 'user')
            ->select('kota', DB::raw('count(*) as total'))
            ->groupBy('kota')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        $eventPerBulan = Event::select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('count(*) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.reports.index', compact('sportPopuler', 'kotaTerbanyak', 'eventPerBulan'));
    }
}
