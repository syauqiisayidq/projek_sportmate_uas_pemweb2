@extends('layouts.app')
@section('title', 'Edit Profil - SportMate')
@section('content')
    <h1 class="text-xl font-bold text-navy mb-4">Edit Profil</h1>

    @if($errors->any())
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm max-w-xl">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 border border-slate-100 space-y-4 max-w-xl">
        @csrf @method('PUT')
        <div class="flex items-center gap-4">
            <img src="{{ $user->foto_url }}" class="w-16 h-16 rounded-full object-cover">
            <div class="flex-1">
                <label class="text-sm font-medium text-slate-600">Foto Profil</label>
                <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-sm font-medium text-slate-600">Jenis Kelamin</label>
                <select name="gender" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
                    <option value="Laki-laki" {{ $user->gender === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $user->gender === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Kota</label>
            <input type="text" name="kota" value="{{ old('kota', $user->kota) }}" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Bio</label>
            <textarea name="bio" rows="2" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">{{ old('bio', $user->bio) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-sm font-medium text-slate-600">Password Baru (opsional)</label>
                <input type="password" name="password" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Konfirmasi</label>
                <input type="password" name="password_confirmation" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
            </div>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Simpan Perubahan</button>
    </form>
@endsection
