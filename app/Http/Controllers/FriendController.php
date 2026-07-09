<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $friends = $user->friends();

        $pending = Friend::with('pengirim')
            ->where('penerima_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $sentPending = Friend::with('penerima')
            ->where('pengirim_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('friends.index', compact('friends', 'pending', 'sentPending'));
    }

    public function request(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if ($authUser->id === $user->id) {
            return back()->with('error', 'Tidak bisa menambahkan diri sendiri.');
        }

        // 🔥 KUNCI PERBAIKAN 1: Bersihkan riwayat 'ditolak' yang menyumbat database
        Friend::where('status', 'ditolak')
            ->where(function ($query) use ($authUser, $user) {
                $query->where([['pengirim_id', $authUser->id], ['penerima_id', $user->id]])
                      ->orWhere([['pengirim_id', $user->id], ['penerima_id', $authUser->id]]);
            })->delete();

        // Setelah bersih, pengecekan ini tidak akan mengira data lama sebagai pertemanan aktif
        if ($authUser->friendStatusWith($user)) {
            return back()->with('error', 'Status pertemanan sudah ada.');
        }

        Friend::create([
            'pengirim_id' => $authUser->id,
            'penerima_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('status', 'Permintaan pertemanan terkirim ke '.$user->nama.'.');
    }

    public function accept(Friend $friend)
    {
        abort_unless($friend->penerima_id === Auth::id(), 403);
        $friend->update(['status' => 'diterima']);

        return back()->with('status', 'Permintaan pertemanan diterima.');
    }

    public function reject(Friend $friend)
    {
        abort_unless($friend->penerima_id === Auth::id(), 403);
        
        // 🔥 KUNCI PERBAIKAN 2: Langsung hapus beneran dari database 
        // Supaya jalurnya bersih kembali jika suatu hari ingin add friend lagi
        $friend->delete();

        return back()->with('status', 'Permintaan pertemanan ditolak.');
    }

    public function cancel(Friend $friend)
    {
        abort_unless($friend->pengirim_id === Auth::id(), 403);
        $friend->delete();

        return back()->with('status', 'Permintaan pertemanan dibatalkan.');
    }

    public function destroy(User $user)
    {
        $authId = Auth::id();

        $friendship = Friend::where('status', 'diterima')
            ->where(function ($query) use ($authId, $user) {
                $query->where([['pengirim_id', $authId], ['penerima_id', $user->id]])
                      ->orWhere([['pengirim_id', $user->id], ['penerima_id', $authId]]);
            })->first();

        if ($friendship) {
            $friendship->delete();
            return back()->with('status', 'Berhasil menghapus pertemanan dengan ' . $user->nama . '.');
        }

        return back()->with('error', 'Gagal memproses, data pertemanan tidak ditemukan.');
    }
}