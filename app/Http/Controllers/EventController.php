<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // 1. MODIFIKASI: Hapus ->where('status', '!=', 'canceled') supaya event canceled TETAP DIPANGGIL
        $query = Event::with(['sport', 'creator', 'participants']);

        if ($request->filled('sport_id')) {
            $query->where('sport_id', $request->sport_id);
        }

        if ($request->filled('q')) {
            $query->where('nama_event', 'like', '%'.$request->q.'%');
        }

        // 2. MODIFIKASI: Ganti pengurutan default dengan orderByRaw FIELD status, lalu disusul tanggal dan jam
        $events = $query->orderByRaw("FIELD(status, 'upcoming', 'ongoing', 'completed', 'canceled')")
                        ->orderBy('tanggal', 'asc')
                        ->orderBy('jam', 'asc')
                        ->get();

        $sports = Sport::orderBy('nama_sport')->get();

        return view('events.index', compact('events', 'sports'));
    }

    public function create()
    {
        $sports = Sport::orderBy('nama_sport')->get();

        return view('events.create', compact('sports'));
    }

    public function store(Request $request)
    {
        // Menyisipkan kolom jam_selesai dan aturan validasi 'after:jam'
        $data = $request->validate([
            'nama_event' => ['required', 'string', 'max:255'],
            'sport_id' => ['required', 'exists:sports,id'],
            'tanggal' => ['required', 'date'],
            'jam' => ['required'],
            'jam_selesai' => ['required', 'after:jam'], // Jam selesai harus setelah jam mulai
            'lokasi' => ['required', 'string', 'max:255'],
            'kuota' => ['required', 'integer', 'min:1'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ], [
            // Pesan error kustom bahasa Indonesia
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai!',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'upcoming';

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('events', 'public');
        }

        // Karena jam_selesai sudah lolos validasi, otomatis ikut tersimpan di sini
        $event = Event::create($data);

        EventParticipant::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'status' => 'joined',
            'joined_at' => now(),
        ]);

        return redirect()->route('events.show', $event)->with('status', 'Event berhasil dibuat dan dipublikasikan!');
    }

    public function show(Event $event)
    {
        $event->load(['sport', 'creator', 'joinedUsers']);
        $isJoined = $event->joinedUsers->contains(Auth::id());

        return view('events.show', compact('event', 'isJoined'));
    }

    public function join(Event $event)
    {
        $user = Auth::user();

        if ($event->joinedUsers->contains($user->id)) {
            return back()->with('error', 'Anda sudah bergabung ke event ini.');
        }

        if ($event->isFull()) {
            return back()->with('error', 'Kuota event sudah penuh.');
        }

        EventParticipant::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'joined',
            'joined_at' => now(),
        ]);

        return back()->with('status', 'Berhasil bergabung ke event '.$event->nama_event.'!');
    }

    public function leave(Event $event)
    {
        EventParticipant::where('user_id', Auth::id())->where('event_id', $event->id)->delete();

        return back()->with('status', 'Anda keluar dari event ini.');
    }

    /**
     * Membatalkan Event dengan Proteksi Kepemilikan (Hanya Creator)
     */
    public function cancel(Event $event)
    {
        // KEAMANAN TINGKAT SERVER: Cek apakah user yang login beneran PEMBUAT event ini
        if ($event->user_id !== Auth::id()) {
            // Jika nakal/iseng lewat URL, langsung lempar error 403 Forbidden
            abort(403, 'Aksi tidak diizinkan. Ini bukan event yang Anda buat!');
        }

        // Ubah status event di database menjadi 'canceled'
        $event->update([
            'status' => 'canceled'
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('status', 'Event berhasil dibatalkan.');
    }
}