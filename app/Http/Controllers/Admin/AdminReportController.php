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
            
        // [UPDATE DI SINI] Ambil data dan jadikan format array [bulan => total]
        $dataEvent = Event::select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('count(*) as total'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Looping 12 bulan biar grafiknya penuh dari Jan - Des
        $eventPerBulan = collect();
        for ($i = 1; $i <= 12; $i++) {
            $eventPerBulan->push((object)[
                'bulan' => $i,
                'total' => $dataEvent[$i] ?? 0 // Kalau kosong, kasih angka 0
            ]);
        }

        return view('admin.reports.index', compact('sportPopuler', 'kotaTerbanyak', 'eventPerBulan'));
    }
}