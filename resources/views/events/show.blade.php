@extends('layouts.app')
@section('title', $event->nama_event.' - SportMate')
@section('content')
    <a href="{{ route('events.index') }}" class="text-sm text-slate-400 mb-4 inline-flex items-center gap-1">&larr; Detail Event</a>

    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 max-w-2xl">
        <div class="block relative overflow-hidden border border-slate-100 rounded-2xl mb-4 shadow-soft group">
        <div class="relative h-32 bg-gradient-to-br from-primaryLight via-primary to-navy overflow-hidden flex items-center justify-center text-white font-bold text-lg">
        <svg class="absolute -right-6 -top-6 w-40 h-40 text-white/10"
                     viewBox="0 0 100 100"
                     fill="none">
                    <circle cx="50" cy="50" r="48" stroke="currentColor" stroke-width="2"/>
                    <circle cx="50" cy="50" r="32" stroke="currentColor" stroke-width="2"/>
                </svg>
            {{ $event->sport->nama_sport ?? '' }}
        </div>
        <div class="p-6">
            {{-- Menyesuaikan warna badge jika status dikesampingkan/canceled --}}
            @if($event->status === 'canceled')
                <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">Canceled</span>
            @else
                <span class="text-xs bg-primary/10 text-primary-dark px-2 py-0.5 rounded-full font-semibold">{{ ucfirst($event->status) }}</span>
            @endif

            <h1 class="text-xl font-bold text-navy mt-2">{{ $event->nama_event }}</h1>
            <p class="text-sm text-slate-400 flex items-center gap-2 mt-1">
                <img src="{{ $event->creator->foto_url }}" class="w-5 h-5 rounded-full">
                Dibuat oleh {{ $event->creator->nama }}
            </p>

            <div class="grid grid-cols-2 gap-4 mt-5">
                <div>
                    <p class="text-xs text-slate-400">Tanggal</p>
                    <p class="text-sm font-semibold text-navy">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Jam</p>
                    {{-- BONUS: Sudah ditambahkan jam_selesai agar sinkron dengan halaman depan --}}
                    <p class="text-sm font-semibold text-navy">{{ substr($event->jam,0,5) }} - {{ substr($event->jam_selesai,0,5) }} WIB</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-slate-400">Lokasi</p>
                    <p class="text-sm font-semibold text-navy">{{ $event->lokasi }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-slate-400">Kuota Peserta</p>
                    <p class="text-sm font-semibold text-navy">{{ $event->joinedUsers->count() }} / {{ $event->kuota }}</p>
                </div>
            </div>

            <div class="mt-5">
                <p class="text-xs text-slate-400 mb-1">Deskripsi</p>
                <p class="text-sm text-slate-600">{{ $event->deskripsi ?: '-' }}</p>
            </div>

            <div class="mt-5">
                <p class="text-xs text-slate-400 mb-2">Peserta ({{ $event->joinedUsers->count() }})</p>
                <div class="flex -space-x-2">
                    @foreach($event->joinedUsers->take(8) as $p)
                        <img src="{{ $p->foto_url }}" title="{{ $p->nama }}" class="w-9 h-9 rounded-full border-2 border-white object-cover">
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                {{-- 1. CEK: Apakah user yang login saat ini adalah si PEMBUAT event? --}}
                @if($event->user_id === Auth::id())
                    
                    {{-- Jika statusnya BENAR-BENAR sudah canceled, munculkan teks peringatan --}}
                    @if($event->status === 'canceled')
                        <div class="w-full bg-red-50 text-red-600 text-center font-semibold py-3 rounded-xl border border-red-200 shadow-sm">
                            🔴 Event Ini Telah Anda Batalkan
                        </div>
                    {{-- Jika statusnya BELUM canceled (misal: upcoming), baru munculkan tombol merah --}}
                    @else
                        <form method="POST" action="{{ route('events.cancel', $event) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan event ini, Bung?')">
                            @csrf
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-xl transition shadow-sm text-center">
                                🔴 Batalkan Event Ini
                            </button>
                        </form>
                    @endif

                @else
                    {{-- 2. KONDISI JIKA USER BIASA (Bukan Pembuat Event) --}}
                    @if($event->status === 'canceled')
                        <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-3 rounded-xl cursor-not-allowed">Event Dibatalkan oleh Penyelenggara</button>
                    @elseif($isJoined)
                        <form method="POST" action="{{ route('events.leave', $event) }}">
                            @csrf
                            <button class="w-full bg-slate-100 text-slate-500 font-semibold py-3 rounded-xl">Keluar dari Event</button>
                        </form>
                    @elseif($event->isFull())
                        <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-3 rounded-xl">Kuota Penuh</button>
                    @else
                        <form method="POST" action="{{ route('events.join', $event) }}">
                            @csrf
                            <button class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Join Event</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection