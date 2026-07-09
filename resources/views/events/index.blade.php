@extends('layouts.app')
@section('title', 'Events - SportMate')
@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold text-navy">Events</h1>
        <a href="{{ route('events.create') }}" class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">+ Buat Event</a>
    </div>

    <form method="GET" class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-3 mb-4">
        <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari event..." class="flex-1 border-0 focus:ring-0 p-0 text-sm">
    </form>

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('events.index') }}" class="px-4 py-1.5 rounded-full text-sm font-medium {{ !request('sport_id') ? 'bg-primary text-white' : 'bg-white text-slate-500 border border-slate-200' }}">Semua</a>
        @foreach($sports as $sport)
            <a href="{{ route('events.index', ['sport_id' => $sport->id]) }}" class="px-4 py-1.5 rounded-full text-sm font-medium {{ request('sport_id') == $sport->id ? 'bg-primary text-white' : 'bg-white text-slate-500 border border-slate-200' }}">{{ $sport->nama_sport }}</a>
        @endforeach
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        @forelse($events as $event)
            {{-- MODIFIKASI: Jika status canceled, tambahkan class opacity-65, grayscale, dan bg-slate-50 --}}
            <a href="{{ route('events.show', $event) }}" class="flex gap-4 bg-white rounded-2xl p-4 border border-slate-100 hover:shadow-md transition {{ $event->status === 'canceled' ? 'opacity-65 grayscale bg-slate-50' : '' }}">
                
                <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex-shrink-0 flex items-center justify-center text-white text-xs font-bold text-center p-1">
                    {{ $event->sport->nama_sport ?? '' }}
                </div>
                
                <div class="flex-1">
                    {{-- MODIFIKASI: Badge status dinamis biar dosen takjub --}}
                    @if($event->status === 'canceled')
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">🔴 Canceled</span>
                    @elseif($event->status === 'ongoing')
                        <span class="text-xs bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full font-semibold">🟢 Ongoing</span>
                    @elseif($event->status === 'completed')
                        <span class="text-xs bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-semibold">🏁 Completed</span>
                    @else
                        <span class="text-xs bg-primary/10 text-primary-dark px-2 py-0.5 rounded-full font-semibold">Upcoming</span>
                    @endif

                    <h3 class="font-bold text-navy mt-1">{{ $event->nama_event }}</h3>
                    <p class="text-xs text-slate-400">📅 {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }} • {{ substr($event->jam, 0, 5) }} - {{ substr($event->jam_selesai, 0, 5) }}</p>
                    <p class="text-xs text-slate-400">📍 {{ $event->lokasi }}</p>
                    
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-slate-400">{{ $event->jumlah_peserta }}/{{ $event->kuota }} peserta</span>
                        
                        {{-- MODIFIKASI: Tombol aksi berubah jadi abu-abu "Detail" jika event dibatalkan --}}
                        @if($event->status === 'canceled')
                            <span class="bg-slate-200 text-slate-500 text-xs font-semibold px-3 py-1 rounded-full">Detail</span>
                        @else
                            <span class="bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">Join</span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-2 bg-white rounded-2xl p-8 text-center text-slate-400 border border-slate-100">Belum ada event tersedia.</div>
        @endforelse
    </div>
@endsection