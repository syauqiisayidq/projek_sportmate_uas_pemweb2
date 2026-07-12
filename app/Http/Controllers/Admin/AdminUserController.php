<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->withCount(['sports', 'joinedEvents']);

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->q.'%')
                    ->orWhere('email', 'like', '%'.$request->q.'%');
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
{
    $user->load([
        'sports',
        'joinedEvents',
    ]);

    return view('admin.users.show', compact('user'));
}

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'Pengguna berhasil dihapus.');
    }
}
