@extends('layouts.admin')
@section('title', 'Kelola Users - SportMate Admin')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-navy">Users</h1>
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/email..." class="rounded-xl border-slate-200 text-sm focus:border-primary focus:ring-primary">
            <button class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-400">   
                <th class="p-4">Foto</th>
                <th class="p-4">Nama</th>
                <th class="p-4">Email</th>
                <th class="p-4">Kota</th>
                <th class="p-4">Olahraga</th>
                <th class="p-4">Event Diikuti</th>
                <th class="p-4 text-right">Aksi</th>
            </tr>
                
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr class="border-t border-slate-50">

    <td class="p-4">
        @if($u->foto)
            <img src="{{ asset('storage/' . $u->foto) }}"
                 class="w-12 h-12 rounded-full object-cover">
        @else
            <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold">
                {{ strtoupper(substr($u->nama,0,1)) }}
            </div>
        @endif
    </td>

    <td class="p-4 font-medium text-navy">
        {{ $u->nama }}
    </td>

    <td class="p-4 text-slate-500">
        {{ $u->email }}
    </td>

    <td class="p-4 text-slate-500">
        {{ $u->kota ?? '-' }}
    </td>

    <td class="p-4 text-slate-500">
        {{ $u->sports_count }}
    </td>

    <td class="p-4 text-slate-500">
        {{ $u->joined_events_count }}
    </td>

    <td class="p-4 text-right">

        <a href="{{ route('admin.users.show',$u) }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-2 rounded-lg">
            Detail
        </a>

        <form method="POST"
              action="{{ route('admin.users.destroy',$u) }}"
              class="inline-block"
              onsubmit="return confirm('Hapus pengguna ini?')">

            @csrf
            @method('DELETE')

            <button class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded-lg">
                Hapus
            </button>

        </form>

    </td>

</tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
@endsection
