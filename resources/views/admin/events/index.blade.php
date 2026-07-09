@extends('layouts.admin')
@section('title', 'Kelola Events - SportMate Admin')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-navy">Events</h1>
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari event..." class="rounded-xl border-slate-200 text-sm focus:border-primary focus:ring-primary">
            <button class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-400">
                    <th class="p-4">Nama Event</th><th class="p-4">Pembuat</th><th class="p-4">Tanggal</th><th class="p-4">Peserta</th><th class="p-4">Status</th><th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr class="border-t border-slate-50">
                        <td class="p-4 font-medium text-navy">{{ $event->nama_event }}</td>
                        <td class="p-4 text-slate-500">{{ $event->creator->nama }}</td>
                        <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
                        <td class="p-4 text-slate-500">{{ $event->participants_count }}/{{ $event->kuota }}</td>
                        <td class="p-4">
                            <form method="POST" action="{{ route('admin.events.status', $event) }}">
                                @csrf @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="text-xs rounded-lg border-slate-200 focus:border-primary focus:ring-primary">
                                    @foreach(['upcoming','ongoing','completed','canceled'] as $status)
                                        <option value="{{ $status }}" {{ $event->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-right">
                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Hapus event ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $events->links() }}</div>
@endsection
