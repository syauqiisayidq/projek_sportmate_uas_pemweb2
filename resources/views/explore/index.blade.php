@extends('layouts.app')
@section('title', 'Cari Teman - SportMate')
@section('content')
    <h1 class="text-xl font-bold text-navy mb-4">Explore (Cari Teman)</h1>

    <form method="GET" class="space-y-3 mb-6">
        <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-3">
            <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari teman olahraga..." class="flex-1 border-0 focus:ring-0 p-0 text-sm">
            <button class="text-primary text-sm font-semibold">Cari</button>
        </div>
        <div class="flex flex-wrap gap-2">
            <select name="sport_id" onchange="this.form.submit()" class="rounded-full text-sm border-slate-200 focus:border-primary focus:ring-primary">
                <option value="">Semua Olahraga</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}" {{ request('sport_id') == $sport->id ? 'selected' : '' }}>{{ $sport->nama_sport }}</option>
                @endforeach
            </select>
            <input type="text" name="kota" value="{{ request('kota') }}" placeholder="Lokasi/Kota" class="rounded-full text-sm border-slate-200 focus:border-primary focus:ring-primary">
        </div>
    </form>

    <div class="grid md:grid-cols-2 gap-4">
        @forelse($users as $u)
            <a href="{{ route('explore.show', $u) }}" class="flex items-center gap-3 bg-white rounded-2xl p-4 border border-slate-100 hover:shadow-md transition">
                <img src="{{ $u->foto_url }}" class="w-16 h-16 rounded-xl object-cover">
                <div class="flex-1">
                    <p class="font-bold text-navy">{{ $u->nama }}</p>
                    <p class="text-xs text-slate-400">{{ $u->umur ?? '-' }} Tahun • {{ $u->kota }}</p>
                    <p class="text-xs text-primary-dark font-medium">{{ $u->sports->pluck('nama_sport')->join(', ') ?: 'Belum ada minat' }}</p>
                    <p class="text-xs text-emerald-500 font-semibold">{{ $u->match_percent }}% Match</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-lg font-bold">
                    {{ $u->friend_status === 'diterima' ? '✓' : '+' }}
                </span>
            </a>
        @empty
            <div class="col-span-2 bg-white rounded-2xl p-8 text-center text-slate-400 border border-slate-100">Tidak ada pengguna ditemukan.</div>
        @endforelse
    </div>
@endsection
