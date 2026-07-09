<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class AutoUpdateEventStatus extends Command
{
    protected $signature = 'app:auto-update-event-status';
    protected $description = 'Otomatis memperbarui status event berdasarkan jam mulai dan jam selesai';

    public function handle()
    {
        // 1. Ambil semua event yang statusnya masih 'upcoming' atau 'ongoing'
        $events = Event::whereIn('status', ['upcoming', 'ongoing'])->get();
        
        // 🔥 PERBAIKAN 1: Paksa Carbon mengambil waktu saat ini berbasis WIB (Asia/Jakarta)
        $now = Carbon::now('Asia/Jakarta');

        if ($events->isEmpty()) {
            $this->comment("[$now] Tidak ada event aktif yang perlu diperbarui.");
            return;
        }

        foreach ($events as $event) {
            // SOLUSI: Bersihkan tanggal agar HANYA mengambil "YYYY-MM-DD" saja
            $cleanDate = Carbon::parse($event->tanggal)->format('Y-m-d');

            // 🔥 PERBAIKAN 2: Paksa waktu mulai dan selesai event di-parse ke zona waktu WIB juga
            $eventStart = Carbon::parse($cleanDate . ' ' . $event->jam, 'Asia/Jakarta');
            $eventEnd = Carbon::parse($cleanDate . ' ' . $event->jam_selesai, 'Asia/Jakarta');

            // LOGIKA 1: UPCOMING -> ONGOING
            if ($event->status === 'upcoming' && $now->greaterThanOrEqualTo($eventStart) && $now->lessThan($eventEnd)) {
                $event->update(['status' => 'ongoing']);
                $this->info("Event '{$event->nama_event}' otomatis berubah menjadi [Ongoing].");
                continue;
            }

            // LOGIKA 2: ONGOING -> COMPLETED
            if ($event->status === 'ongoing' && $now->greaterThanOrEqualTo($eventEnd)) {
                $event->update(['status' => 'completed']);
                $this->info("Event '{$event->nama_event}' otomatis berubah menjadi [Completed].");
                continue;
            }

            // LOGIKA 3: UPCOMING -> COMPLETED (PROTEKSI JIKA TERLEWAT)
            if ($event->status === 'upcoming' && $now->greaterThanOrEqualTo($eventEnd)) {
                $event->update(['status' => 'completed']);
                $this->info("Event '{$event->nama_event}' terlewat dan otomatis diset [Completed].");
            }
        }
    }
}