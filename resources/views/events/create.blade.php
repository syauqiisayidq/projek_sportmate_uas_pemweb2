@extends('layouts.app')
@section('title', 'Buat Event - SportMate')
@section('content')
    <h1 class="text-xl font-bold text-navy mb-4">Buat Event</h1>

    @if($errors->any())
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 border border-slate-100 space-y-4 max-w-xl">
        @csrf
        <div>
            <label class="text-sm font-medium text-slate-600">Foto Event</label>
            <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Nama Event</label>
            <input type="text" name="nama_event" value="{{ old('nama_event') }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Masukan nama event">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Jenis Olahraga</label>
            <select name="sport_id" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
                <option value="">Pilih olahraga</option>
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}" {{ old('sport_id') == $sport->id ? 'selected' : '' }}>{{ $sport->nama_sport }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="text-sm font-medium text-slate-600">Tanggal</label>
                <input type="text" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary bg-white cursor-pointer text-xs" placeholder="Pilih">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Jam Mulai</label>
                <input type="time" name="jam" value="{{ old('jam') }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary text-xs">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary text-xs">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Tempat lokasi event">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Kuota Peserta</label>
            <input type="number" name="kuota" min="1" value="{{ old('kuota') }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Masukan batas jumlah peserta">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Yuk olahraga bersama untuk hidup lebih sehat!">{{ old('deskripsi') }}</textarea>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Publikasikan Event</button>
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#tanggal", {
            dateFormat: "Y-m-d",
            minDate: "today",
        });
    </script>
@endsection