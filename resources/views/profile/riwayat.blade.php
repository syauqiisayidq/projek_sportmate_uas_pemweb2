@extends('layouts.app')
@section('title', 'Riwayat Aktivitas - SportMate')
@section('content')
    <h1 class="text-xl font-bold text-navy mb-4">Riwayat Aktivitas</h1>

    <div class="mb-6">
        <h2 class="font-bold text-navy text-sm mb-3">Event yang Diikuti</h2>
        <div class="space-y-3">
            @forelse($riwayat as $r)
                <a href="{{ route('events.show', $r->event) }}" class="flex items-center gap-3 bg-white rounded-2xl p-3 border border-slate-100">
                    <div class="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center text-primary-dark text-lg">🏃</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-navy">Bergabung di event {{ $r->event->nama_event }}</p>
                        <p class="text-xs text-slate-400">{{ $r->joined_at?->translatedFormat('d M Y, H:i') }} WIB</p>
                    </div>
                </a>
            @empty
                <p class="text-sm text-slate-400 text-center py-6">Belum ada riwayat event.</p>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="font-bold text-navy text-sm mb-3">Teman Olahraga</h2>
        <div class="space-y-3">
            @forelse($pertemanan as $f)
                @php $lawan = $f->pengirim_id === auth()->id() ? $f->penerima : $f->pengirim; @endphp
                <div class="flex items-center gap-3 bg-white rounded-2xl p-3 border border-slate-100">
                    <img src="{{ $lawan->foto_url }}" class="w-11 h-11 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-navy">Menambahkan teman baru {{ $lawan->nama }}</p>
                        <p class="text-xs text-slate-400">{{ $f->updated_at->translatedFormat('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-400 text-center py-6">Belum ada riwayat pertemanan.</p>
            @endforelse
        </div>
    </div>
@endsection
