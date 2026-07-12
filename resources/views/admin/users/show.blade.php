@extends('layouts.admin')

@section('title', 'Detail User - SportMate Admin')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-navy">Detail User</h1>

    <a href="{{ route('admin.users.index') }}"
       class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-xl">
        ← Kembali
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 p-8">

    <div class="flex items-start gap-8">

        {{-- Foto --}}
        <div class="flex-shrink-0">
            <img src="{{ $user->foto_url }}"
                 class="w-40 h-40 rounded-full object-cover border-4 border-primary">
        </div>

        {{-- Data User --}}
        <div class="grid grid-cols-2 gap-6 flex-1">

            <div>
                <p class="text-sm text-slate-400">Nama</p>
                <p class="font-semibold text-lg text-navy">
                    {{ $user->nama }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Email</p>
                <p class="font-semibold">
                    {{ $user->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Kota</p>
                <p>{{ $user->kota ?: '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Gender</p>
                <p>{{ ucfirst($user->gender) ?: '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Tanggal Lahir</p>
                <p>
                    {{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d F Y') : '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Umur</p>
                <p>{{ $user->umur ? $user->umur.' Tahun' : '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Bergabung Sejak</p>
                <p>{{ $user->created_at->format('d F Y') }}</p>
            </div>

        </div>

    </div>

    {{-- Bio --}}
    <div class="mt-10 border-t pt-8">

        <h2 class="font-bold text-lg text-navy mb-3">
            Bio
        </h2>

        <p class="text-slate-600 leading-relaxed">
            {{ $user->bio ?: 'Belum memiliki bio.' }}
        </p>

    </div>

    {{-- Olahraga --}}
    <div class="mt-10 border-t pt-8">

        <h2 class="font-bold text-lg text-navy mb-4">
            Olahraga Dipilih
        </h2>

        @if($user->sports->count())

            <div class="flex flex-wrap gap-3">

                @foreach($user->sports as $sport)

                    <span class="bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium">
                        {{ $sport->nama_sport }}
                    </span>

                @endforeach

            </div>

        @else

            <p class="text-slate-400">
                Belum memilih olahraga.
            </p>

        @endif

    </div>

    {{-- Event --}}
    <div class="mt-10 border-t pt-8">

        <h2 class="font-bold text-lg text-navy mb-4">
            Event yang Diikuti
        </h2>

        @if($user->joinedEvents->count())

            <div class="space-y-3">

                @foreach($user->joinedEvents as $event)

                    <div class="border border-slate-200 rounded-xl p-4">

                        <div class="font-semibold text-navy">
                            {{ $event->nama_event }}
                        </div>

                        <div class="text-sm text-slate-500 mt-1">
                            Bergabung:
                            {{ $event->pivot->joined_at
                                ? \Carbon\Carbon::parse($event->pivot->joined_at)->format('d M Y')
                                : '-' }}
                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <p class="text-slate-400">
                Belum mengikuti event.
            </p>

        @endif

    </div>

</div>

@endsection