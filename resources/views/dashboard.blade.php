@extends('layouts.app')
@section('title', 'Home - SportMate')
@section('content')
    <div class="mb-6">
        <p class="text-slate-500 text-sm">Good Morning,</p>
        <h1 class="text-2xl font-bold text-navy">{{ $user->nama }}! 👋</h1>
    </div>

    <a href="{{ route('explore.index') }}" class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-3 mb-6 text-slate-400 shadow-sm hover:border-primary transition">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
        Cari olahraga, teman, atau event...
    </a>

    <div class="grid grid-cols-5 gap-3 mb-8">
        @foreach(['Futsal' => 'M12 2a10 10 0 1 0 .1 20A10 10 0 0 0 12 2Z', 'Badminton' => 'M12 2 2 22h20L12 2Z', 'Basket' => 'M12 2a10 10 0 1 0 .1 20A10 10 0 0 0 12 2Z', 'Running' => 'M13 5a2 2 0 1 0-2-2 2 2 0 0 0 2 2Z', 'Cycling' => 'M5 17a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm14 0a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z'] as $label => $icon)
            <a href="{{ route('explore.index', ['q' => $label]) }}" class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary-dark">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="{{ $icon }}"/></svg>
                </div>
                <span class="text-xs text-slate-500 font-medium">{{ $label }}</span>
            </a>
        @endforeach
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-navy">Upcoming Event</h2>
                    <a href="{{ route('events.index') }}" class="text-sm text-primary font-semibold">Lihat semua</a>
                </div>
                @if($upcomingEvent)
                    <a href="{{ route('events.show', $upcomingEvent) }}" class="block bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100 hover:shadow-md transition">
                        <div class="h-32 bg-gradient-to-r from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-lg">
                            {{ $upcomingEvent->sport->nama_sport ?? 'Event' }}
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-navy">{{ $upcomingEvent->nama_event }}</h3>
                            <p class="text-xs text-slate-400 mt-1">📍 {{ $upcomingEvent->lokasi }}</p>
                            <p class="text-xs text-slate-400">🕗 {{ \Carbon\Carbon::parse($upcomingEvent->tanggal)->translatedFormat('l, d M Y') }} • {{ substr($upcomingEvent->jam,0,5) }} WIB</p>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xs bg-slate-100 px-2 py-1 rounded-full text-slate-500">{{ $upcomingEvent->jumlah_peserta }}/{{ $upcomingEvent->kuota }} peserta</span>
                                <span class="bg-primary text-white text-xs font-semibold px-4 py-1.5 rounded-full">Lihat Detail</span>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="bg-white rounded-2xl p-6 text-center text-slate-400 text-sm border border-slate-100">Belum ada event mendatang.</div>
                @endif
            </div>

            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-navy">Rekomendasi Teman</h2>
                    <a href="{{ route('explore.index') }}" class="text-sm text-primary font-semibold">Lihat semua</a>
                </div>
                <div class="space-y-3">
                    @forelse($rekomendasi as $rec)
                        <a href="{{ route('explore.show', $rec) }}" class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100 hover:shadow-sm transition">
                            <div class="flex items-center gap-3">
                                <img src="{{ $rec->foto_url }}" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <p class="font-semibold text-navy text-sm">{{ $rec->nama }}</p>
                                    <p class="text-xs text-slate-400">{{ $rec->sports->pluck('nama_sport')->join(', ') }} • {{ $rec->kota }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-primary">{{ $rec->match_percent }}% Match</span>
                        </a>
                    @empty
                        <div class="bg-white rounded-2xl p-6 text-center text-slate-400 text-sm border border-slate-100">Belum ada rekomendasi teman. Pilih olahraga favoritmu dulu di profil.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <h3 class="font-bold text-navy mb-3">Statistik Kamu</h3>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div>
                        <p class="text-xl font-extrabold text-primary">{{ $stats['teman'] }}</p>
                        <p class="text-xs text-slate-400">Teman</p>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-primary">{{ $stats['event'] }}</p>
                        <p class="text-xs text-slate-400">Event</p>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-primary">{{ $stats['aktivitas'] }}</p>
                        <p class="text-xs text-slate-400">Aktivitas</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <h3 class="font-bold text-navy mb-3">Hari Ini • {{ now()->translatedFormat('d M') }}</h3>
                @forelse($todayEvents as $ev)
                    <a href="{{ route('events.show', $ev) }}" class="flex items-center justify-between py-2 border-b last:border-0 border-slate-50">
                        <div>
                            <p class="text-sm font-semibold text-navy">{{ $ev->nama_event }}</p>
                            <p class="text-xs text-slate-400">{{ substr($ev->jam,0,5) }} • {{ $ev->lokasi }}</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M9 6l6 6-6 6"/></svg>
                    </a>
                @empty
                    <p class="text-sm text-slate-400">Tidak ada jadwal hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
