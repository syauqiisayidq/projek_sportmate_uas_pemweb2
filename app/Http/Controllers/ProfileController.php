<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('sports');
        $stats = [
            'teman' => $user->friends()->count(),
            'event' => $user->joinedEvents()->count(),
            'aktivitas' => $user->eventParticipations()->count(),
        ];

        return view('profile.show', compact('user', 'stats'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'kota' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'tanggal_lahir' => ['nullable', 'date'],
            'bio' => ['nullable', 'string', 'max:500'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'confirmed', 'min:6'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('status', 'Profil berhasil diperbarui.');
    }

    public function riwayat()
    {
        $user = Auth::user();

        $riwayat = EventParticipant::with(['event.sport'])
            ->where('user_id', $user->id)
            ->latest('joined_at')
            ->get();

        $pertemanan = Friend::with(['pengirim', 'penerima'])
            ->where(function ($q) use ($user) {
                $q->where('pengirim_id', $user->id)->orWhere('penerima_id', $user->id);
            })
            ->where('status', 'diterima')
            ->latest()
            ->get();

        return view('profile.riwayat', compact('riwayat', 'pertemanan'));
    }
}
