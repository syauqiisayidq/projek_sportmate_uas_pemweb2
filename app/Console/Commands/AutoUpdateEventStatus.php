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
        $events = Event::whereIn('status', ['upcoming', 'ongoing'])->get();
        
        $now = Carbon::now('Asia/Jakarta');

        if ($events->isEmpty()) {
            $this->comment("[$now] Tidak ada event aktif yang perlu diperbarui.");
            return;
        }

        foreach ($events as $event) {
            $cleanDate = Carbon::parse($event->tanggal)->format('Y-m-d');

            $eventStart = Carbon::parse($cleanDate . ' ' . $event->jam, 'Asia/Jakarta');
            $eventEnd = Carbon::parse($cleanDate . ' ' . $event->jam_selesai, 'Asia/Jakarta');

            if ($event->status === 'upcoming' && $now->greaterThanOrEqualTo($eventStart) && $now->lessThan($eventEnd)) {
                $event->update(['status' => 'ongoing']);
                $this->info("Event '{$event->nama_event}' otomatis berubah menjadi [Ongoing].");
                continue;
            }

            if ($event->status === 'ongoing' && $now->greaterThanOrEqualTo($eventEnd)) {
                $event->update(['status' => 'completed']);
                $this->info("Event '{$event->nama_event}' otomatis berubah menjadi [Completed].");
                continue;
            }
            
            if ($event->status === 'upcoming' && $now->greaterThanOrEqualTo($eventEnd)) {
                $event->update(['status' => 'completed']);
                $this->info("Event '{$event->nama_event}' terlewat dan otomatis diset [Completed].");
            }
        }
    }
}