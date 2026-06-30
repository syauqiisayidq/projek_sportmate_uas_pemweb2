<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hapus data lama agar tidak menumpuk (Opsional)
        \DB::table('friends')->delete();
        \DB::table('users')->delete();

        // 2. Buat User Contoh
        $user1 = User::create([
            'nama' => 'Budi Sport',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
            'tanggal_lahir' => '2000-01-01',
            'gender' => 'Pria',
            'kota' => 'Bandung',
            'role' => 'User'
        ]);

        $user2 = User::create([
            'nama' => 'Siti Atlet',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'tanggal_lahir' => '2000-05-05',
            'gender' => 'Wanita',
            'kota' => 'Jakarta',
            'role' => 'User'
        ]);

        // 3. Buat Friend Request (Budi mengirim ke Siti)
        Friend::create([
            'pengirim_id' => $user1->id,
            'penerima_id' => $user2->id,
            'status' => 'Pending',
        ]);
    }
}