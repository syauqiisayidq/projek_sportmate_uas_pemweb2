@extends('layouts.guest')
@section('title', 'Login - SportMate')
@section('content')
    <h1 class="text-2xl font-bold text-navy mb-1">Selamat Datang Kembali 👋</h1>
    <p class="text-slate-500 text-sm mb-6">Masuk untuk melanjutkan pencarian teman olahragamu.</p>

    @if($errors->any())
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="text-sm font-medium text-slate-600">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="nama@email.com">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Password</label>
            <input type="password" name="password" required
                   class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="••••••••">
        </div>
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-slate-500">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary focus:ring-primary">
                Ingat saya
            </label>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">
            Masuk
        </button>
    </form>

    <p class="text-sm text-slate-500 mt-6 text-center">
        Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-semibold">Daftar sekarang</a>
    </p>

    <div class="mt-6 text-xs text-slate-400 bg-slate-50 rounded-xl p-3">
        Demo akun: <b>verlyn@sportmate.test</b> / <b>password</b><br>
        Demo admin: <b>admin@sportmate.test</b> / <b>password</b>
    </div>
@endsection
