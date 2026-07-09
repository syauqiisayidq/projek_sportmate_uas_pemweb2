<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['sport', 'creator'])->withCount('participants');

        if ($request->filled('q')) {
            $query->where('nama_event', 'like', '%'.$request->q.'%');
        }

        $events = $query->latest()->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function updateStatus(Request $request, Event $event)
    {
        $data = $request->validate([
            'status' => ['required', 'in:upcoming,ongoing,completed,canceled'],
        ]);

        $event->update($data);

        return back()->with('status', 'Status event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return back()->with('status', 'Event berhasil dihapus.');
    }
}
