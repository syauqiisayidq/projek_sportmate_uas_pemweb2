@extends('layouts.admin')
@section('title', 'Dashboard Admin - SportMate')
@section('content')
    <h1 class="text-2xl font-bold text-navy mb-6">Dashboard</h1>

    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-navy">{{ $totalUsers }}</p>
            <p class="text-xs text-slate-400">Total Users</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-navy">{{ $totalEvents }}</p>
            <p class="text-xs text-slate-400">Total Events</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-navy">{{ $totalFriendRequests }}</p>
            <p class="text-xs text-slate-400">Friend Requests</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-navy">{{ $activeUsers }}</p>
            <p class="text-xs text-slate-400">Active Users</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-4">Aktivitas Mingguan</h3>
            <div class="flex items-end gap-3 h-40">
                @php $max = max(1, $aktivitasMingguan->max('total')); @endphp
                @foreach($aktivitasMingguan as $d)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: {{ max(6, ($d['total']/$max)*100) }}%">
                            <div class="absolute inset-x-0 bottom-0 bg-primary rounded-t-lg" style="height:100%"></div>
                        </div>
                        <span class="text-xs text-slate-400">{{ $d['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-3">Event Terbaru</h3>
            <div class="space-y-3">
                @forelse($eventTerbaru as $e)
                    <div class="flex items-center gap-2 text-sm">
                        <span class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-xs">🏆</span>
                        <div>
                            <p class="font-medium text-navy">{{ $e->nama_event }}</p>
                            <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($e->tanggal)->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada event.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-slate-100 mt-4">
        <h3 class="font-bold text-navy mb-3">Pengguna Terbaru</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="pb-2">Nama</th><th class="pb-2">Email</th><th class="pb-2">Kota</th><th class="pb-2">Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penggunaTerbaru as $u)
                    <tr class="border-b border-slate-50 last:border-0">
                        <td class="py-2 font-medium text-navy">{{ $u->nama }}</td>
                        <td class="py-2 text-slate-500">{{ $u->email }}</td>
                        <td class="py-2 text-slate-500">{{ $u->kota }}</td>
                        <td class="py-2 text-slate-500">{{ $u->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
