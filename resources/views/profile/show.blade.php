@extends('layouts.app')
@section('title', 'Profil Saya - SportMate')
@section('content')
    <div class="max-w-xl">
        <div class="bg-primary rounded-3xl p-6 text-white text-center relative">
            <a href="{{ route('profile.edit') }}" class="absolute right-5 top-5 text-white/80 text-sm">Edit</a>
            
            {{-- 💡 MODIFIKASI: Gunakan onclick="openPhotoModal()" --}}
            <img src="{{ $user->foto_url }}" 
                 onclick="openPhotoModal()"
                 class="w-20 h-20 rounded-full mx-auto border-4 border-white/40 object-cover cursor-pointer hover:opacity-90 transition">
            
            <h1 class="font-bold text-lg mt-3">{{ $user->nama }}</h1>
            <p class="text-white/80 text-sm">{{ $user->kota }}</p>
            @if($user->bio)
                <span class="inline-block bg-white/20 text-xs font-semibold px-3 py-1 rounded-full mt-2">{{ $user->bio }}</span>
            @endif
            <div class="grid grid-cols-3 gap-2 mt-5 bg-white/10 rounded-2xl p-4">
                <div><p class="text-xl font-extrabold">{{ $stats['teman'] }}</p><p class="text-xs text-white/70">Teman</p></div>
                <div><p class="text-xl font-extrabold">{{ $stats['event'] }}</p><p class="text-xs text-white/70">Event</p></div>
                <div><p class="text-xl font-extrabold">{{ $stats['aktivitas'] }}</p><p class="text-xs text-white/70">Aktivitas</p></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl mt-4 border border-slate-100 divide-y divide-slate-50">
            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Edit Profil <span class="text-slate-300">›</span>
            </a>
            <a href="{{ route('sports.pick') }}" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Olahraga Favorit <span class="text-slate-300">›</span>
            </a>
            <a href="{{ route('profile.riwayat') }}" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Riwayat Aktivitas <span class="text-slate-300">›</span>
            </a>
            <a href="{{ route('friends.index') }}" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Teman & Pertemanan <span class="text-slate-300">›</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl mt-4 p-4 border border-slate-100">
            <h3 class="font-bold text-navy text-sm mb-2">Olahraga Favorit</h3>
            <div class="flex flex-wrap gap-2">
                @forelse($user->sports as $sport)
                    <span class="bg-primary/10 text-primary-dark text-xs font-semibold px-3 py-1 rounded-full">{{ $sport->nama_sport }}</span>
                @empty
                    <p class="text-sm text-slate-400">Belum memilih olahraga favorit.</p>
                @endforelse
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button class="w-full text-red-500 font-semibold py-3 rounded-xl bg-white border border-red-100">Keluar</button>
        </form>

        {{-- 💡 MODIFIKASI: Komponen Lightbox Modal (Menggunakan class hidden Tailwind) --}}
        <div id="photoLightbox" onclick="closePhotoModal()" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4">
            <div class="relative max-w-md w-full aspect-square bg-white rounded-3xl overflow-hidden p-2 shadow-2xl" onclick="event.stopPropagation()">
                <img src="{{ $user->foto_url }}" class="w-full h-full rounded-2xl object-cover">
                <button onclick="closePhotoModal()" class="absolute top-4 right-4 bg-black/50 text-white hover:bg-black/70 w-8 h-8 rounded-full flex items-center justify-center font-bold transition">✕</button>
            </div>
        </div>
    </div>

    {{-- Script JavaScript Aktif Modalnya --}}
    <script>
        function openPhotoModal() {
            const modal = document.getElementById('photoLightbox');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closePhotoModal() {
            const modal = document.getElementById('photoLightbox');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
@endsection