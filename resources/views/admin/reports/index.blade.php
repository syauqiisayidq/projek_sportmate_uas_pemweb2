@extends('layouts.admin')
@section('title', 'Laporan - SportMate Admin')
@section('content')
    <h1 class="text-2xl font-bold text-navy mb-6">Laporan & Monitoring</h1>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-4">Olahraga Terpopuler</h3>
            <div class="space-y-3">
                @foreach($sportPopuler as $s)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600">{{ $s->nama_sport }}</span>
                        <span class="font-semibold text-primary-dark">{{ $s->users_count }} peminat</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-4">Kota dengan Pengguna Terbanyak</h3>
            <div class="space-y-3">
                @foreach($kotaTerbanyak as $k)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600">{{ $k->kota }}</span>
                        <span class="font-semibold text-primary-dark">{{ $k->total }} pengguna</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100 col-span-2">
            <h3 class="font-bold text-navy mb-4">Jumlah Event per Bulan</h3>
            <div class="flex items-end gap-3 h-40">
                @php
                    $bulanLabel = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    $max = max(1, $eventPerBulan->max('total'));
                @endphp
                @foreach($eventPerBulan as $e)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-primary rounded-t-lg" style="height: {{ max(6, ($e->total/$max)*100) }}%"></div>
                        <span class="text-xs text-slate-400">{{ $bulanLabel[$e->bulan] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
