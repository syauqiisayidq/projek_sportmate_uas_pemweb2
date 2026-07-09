@extends('layouts.app')
@section('title', 'Teman - SportMate')
@section('content')
    <h1 class="text-xl font-bold text-navy mb-4">Teman</h1>

    <div>
        <div class="flex gap-6 border-b border-slate-100 mb-4 text-sm font-semibold">
            <button onclick="showTab('permintaan')" id="tab-permintaan" class="pb-3 text-primary border-b-2 border-primary">Permintaan ({{ $pending->count() }})</button>
            <button onclick="showTab('pending')" id="tab-pending" class="pb-3 text-slate-400">Terkirim ({{ $sentPending->count() }})</button>
            <button onclick="showTab('teman')" id="tab-teman" class="pb-3 text-slate-400">Teman ({{ $friends->count() }})</button>
        </div>

        {{-- Panel Permintaan Pertemanan --}}
        <div id="panel-permintaan" class="space-y-3">
            @forelse($pending as $p)
                <div class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100">
                    {{-- 💡 KUNCI UX: Foto & Nama dibungkus tag <a> agar bisa diklik menuju profil --}}
                    <a href="{{ route('explore.show', $p->pengirim) }}" class="flex items-center gap-3 flex-1 hover:opacity-80 transition">
                        <img src="{{ $p->pengirim->foto_url }}" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-navy text-sm">{{ $p->pengirim->nama }}</p>
                            <p class="text-xs text-slate-400">{{ $p->pengirim->umur ?? '-' }} Tahun • {{ $p->pengirim->kota }}</p>
                        </div>
                    </a>
                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('friends.accept', $p) }}">
                            @csrf
                            <button class="bg-primary text-white text-xs font-semibold px-4 py-2 rounded-lg">Terima</button>
                        </form>
                        <form method="POST" action="{{ route('friends.reject', $p) }}">
                            @csrf
                            <button class="bg-slate-100 text-slate-500 text-xs font-semibold px-4 py-2 rounded-lg">Tolak</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-400 text-center py-8">Tidak ada permintaan pertemanan.</p>
            @endforelse
        </div>

        {{-- Panel Permintaan Terkirim --}}
        <div id="panel-pending" class="space-y-3 hidden">
            @forelse($sentPending as $p)
                <div class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100">
                    <a href="{{ route('explore.show', $p->penerima) }}" class="flex items-center gap-3 flex-1 hover:opacity-80 transition">
                        <img src="{{ $p->penerima->foto_url }}" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-navy text-sm">{{ $p->penerima->nama }}</p>
                            <p class="text-xs text-slate-400">Menunggu respon</p>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('friends.cancel', $p) }}">
                        @csrf @method('DELETE')
                        <button class="bg-slate-100 text-slate-500 text-xs font-semibold px-4 py-2 rounded-lg">Batalkan</button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-slate-400 text-center py-8">Belum ada permintaan terkirim.</p>
            @endforelse
        </div>

        {{-- Panel Daftar Teman Aktif --}}
        <div id="panel-teman" class="space-y-3 hidden">
            @forelse($friends as $f)
                <div class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100">
                    <a href="{{ route('explore.show', $f) }}" class="flex items-center gap-3 flex-1 hover:opacity-80 transition">
                        <img src="{{ $f->foto_url }}" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-navy text-sm">{{ $f->nama }}</p>
                            <p class="text-xs text-slate-400">{{ $f->umur ?? '-' }} Tahun • {{ $f->kota }}</p>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('friends.destroy', $f->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertemanan dengan {{ $f->nama }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 bg-red-50 hover:bg-red-100 text-xs font-semibold px-3 py-2 rounded-xl transition">
                            Hapus Teman
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-slate-400 text-center py-8">Belum ada teman. Yuk cari teman baru!</p>
            @endforelse
        </div>
    </div>

    <script>
        function showTab(name) {
            ['permintaan', 'pending', 'teman'].forEach(t => {
                document.getElementById('panel-' + t).classList.toggle('hidden', t !== name);
                document.getElementById('tab-' + t).classList.toggle('text-primary', t === name);
                document.getElementById('tab-' + t).classList.toggle('border-b-2', t === name);
                document.getElementById('tab-' + t).classList.toggle('border-primary', t === name);
                document.getElementById('tab-' + t).classList.toggle('text-slate-400', t !== name);
            });
        }
    </script>
@endsection