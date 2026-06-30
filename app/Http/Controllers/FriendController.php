<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    // Hanya fungsi ini saja dulu agar data tampil di halaman
    // Jangan lupa tambahkan ini di paling atas file

    public function index(Request $request) 
    {
        $userId = Auth::id(); // Mengambil ID user yang sedang login
        $tab = $request->query('tab', 'masuk'); 

        if ($tab == 'masuk') {
            // Logika: Saya adalah penerima (penerima_id), statusnya Pending
            $friends = \App\Models\Friend::where('penerima_id', $userId)
                                        ->where('status', 'Pending')
                                        ->get();
        } else {
            // Logika: Saya adalah pengirim (pengirim_id), statusnya Sent/Pending
            $friends = \App\Models\Friend::where('pengirim_id', $userId)
                                        ->get();
        }

        return view('friends.index', compact('friends', 'tab'));
    }
}