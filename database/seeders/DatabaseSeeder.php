<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Friend;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Admin SportMate',
            'email' => 'admin@sportmate.test',
            'password' => Hash::make('password'),
            'kota' => 'Bandung',
            'gender' => 'Laki-laki',
            'role' => 'admin',
        ]);

        // Sports
        $sportNames = ['Futsal', 'Badminton', 'Basket', 'Running', 'Cycling', 'Voli', 'Renang', 'Tenis Meja'];
        $sports = collect($sportNames)->map(fn ($n) => Sport::create(['nama_sport' => $n]));

        // Demo users
        $demoUsers = [
            ['nama' => 'Verlyn Juliani', 'email' => 'verlyn@sportmate.test', 'kota' => 'Bandung', 'gender' => 'Perempuan', 'bio' => 'Badminton Lover'],
            ['nama' => 'Rizky Maulana', 'email' => 'rizky@sportmate.test', 'kota' => 'Bandung', 'gender' => 'Laki-laki', 'bio' => 'Suka olahraga dan mencari teman baru untuk berolahraga bersama.'],
            ['nama' => 'Dinda Putri', 'email' => 'dinda@sportmate.test', 'kota' => 'Bandung', 'gender' => 'Perempuan', 'bio' => 'Futsal enthusiast.'],
            ['nama' => 'Fajar Nugroho', 'email' => 'fajar@sportmate.test', 'kota' => 'Cimahi', 'gender' => 'Laki-laki', 'bio' => 'Basket setiap weekend.'],
            ['nama' => 'Nadia Aulia', 'email' => 'nadia@sportmate.test', 'kota' => 'Bandung', 'gender' => 'Perempuan', 'bio' => 'Running pagi hari.'],
            ['nama' => 'Budi Santoso', 'email' => 'budi@sportmate.test', 'kota' => 'Bandung', 'gender' => 'Laki-laki', 'bio' => 'Cycling weekend warrior.'],
        ];

        $users = collect($demoUsers)->map(function ($u) {
            return User::create([
                'nama' => $u['nama'],
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'kota' => $u['kota'],
                'gender' => $u['gender'],
                'bio' => $u['bio'],
                'tanggal_lahir' => now()->subYears(rand(20, 27))->subDays(rand(1, 300)),
                'role' => 'user',
            ]);
        });

        // Attach random sports to each user
        foreach ($users as $u) {
            $u->sports()->attach(
                $sports->random(rand(1, 3))->pluck('id')->mapWithKeys(fn ($id) => [$id => ['jadwal' => 'Sabtu & Minggu']])
            );
        }

        // Friend relations
        Friend::create(['pengirim_id' => $users[1]->id, 'penerima_id' => $users[0]->id, 'status' => 'diterima']);
        Friend::create(['pengirim_id' => $users[2]->id, 'penerima_id' => $users[0]->id, 'status' => 'pending']);
        Friend::create(['pengirim_id' => $users[3]->id, 'penerima_id' => $users[0]->id, 'status' => 'pending']);
        Friend::create(['pengirim_id' => $users[4]->id, 'penerima_id' => $users[0]->id, 'status' => 'pending']);
        Friend::create(['pengirim_id' => $users[5]->id, 'penerima_id' => $users[0]->id, 'status' => 'pending']);

        // Events
        $futsal = $sports->firstWhere('nama_sport', 'Futsal');
        $badminton = $sports->firstWhere('nama_sport', 'Badminton');
        $running = $sports->firstWhere('nama_sport', 'Running');

        $event1 = Event::create([
            'user_id' => $users[0]->id,
            'sport_id' => $running->id,
            'nama_event' => 'Morning Run',
            'tanggal' => now()->addDays(16)->toDateString(),
            'jam' => '07:00',
            'lokasi' => 'Lapangan Gasibu, Bandung',
            'kuota' => 15,
            'deskripsi' => 'Yuk lari pagi bersama untuk hidup lebih sehat! Semua level welcome!',
            'status' => 'upcoming',
        ]);

        $event2 = Event::create([
            'user_id' => $users[2]->id,
            'sport_id' => $futsal->id,
            'nama_event' => 'Futsal Community',
            'tanggal' => now()->addDays(17)->toDateString(),
            'jam' => '08:00',
            'lokasi' => 'Lapangan Kick Off, Bandung',
            'kuota' => 10,
            'deskripsi' => 'Sparring futsal santai untuk komunitas SportMate.',
            'status' => 'upcoming',
        ]);

        $event3 = Event::create([
            'user_id' => $users[0]->id,
            'sport_id' => $badminton->id,
            'nama_event' => 'Badminton Fun Match',
            'tanggal' => now()->addDays(18)->toDateString(),
            'jam' => '08:00',
            'lokasi' => 'GOR Silliwangi, Bandung',
            'kuota' => 12,
            'deskripsi' => 'Main badminton santai sambil kenalan sama teman baru.',
            'status' => 'upcoming',
        ]);

        foreach ([$event1, $event2, $event3] as $event) {
            EventParticipant::create([
                'user_id' => $event->user_id,
                'event_id' => $event->id,
                'status' => 'joined',
                'joined_at' => now(),
            ]);
        }

        // A few extra joins for realism
        EventParticipant::create([
            'user_id' => $users[1]->id,
            'event_id' => $event1->id,
            'status' => 'joined',
            'joined_at' => now(),
        ]);

        EventParticipant::create([
            'user_id' => $users[3]->id,
            'event_id' => $event3->id,
            'status' => 'joined',
            'joined_at' => now(),
        ]);
    }
}
