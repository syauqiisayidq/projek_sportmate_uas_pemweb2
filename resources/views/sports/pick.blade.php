@extends('layouts.guest')
@section('title', 'Pilih Olahraga - SportMate')
@section('content')
    <h1 class="text-2xl font-bold text-navy mb-1">Pilih Olahraga Favoritmu 🏸</h1>
    <p class="text-slate-500 text-sm mb-6">Kami akan mencarikan teman dengan minat yang sama.</p>

    @if(session('status'))
        <div class="mb-4 bg-primary/10 text-primary-dark px-4 py-3 rounded-xl text-sm">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('sports.save') }}" class="space-y-5">
        @csrf
        <div class="grid grid-cols-3 gap-3">
            @foreach($sports as $sport)
                <label class="cursor-pointer">
                    <input type="checkbox" name="sports[]" value="{{ $sport->id }}" class="hidden peer"
                           {{ in_array($sport->id, $mySportIds) ? 'checked' : '' }}>
                    <div class="border border-slate-200 rounded-xl py-4 text-center peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:text-primary-dark transition">
                        <div class="text-sm font-semibold">{{ $sport->nama_sport }}</div>
                    </div>
                </label>
            @endforeach
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Jadwal biasa berolahraga</label>
            <input type="text" name="jadwal" placeholder="Contoh: Sabtu & Minggu" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">
            Simpan & Lanjutkan
        </button>
    </form>
@endsection
