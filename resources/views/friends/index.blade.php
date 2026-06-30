@extends('layouts.app')

@section('content')
    <h2>Manajemen Pertemanan</h2>

    <div class="btn-group mb-3">
        <a href="{{ route('friends.index', ['tab' => 'masuk']) }}" class="btn btn-primary">Permintaan Masuk</a>
        <a href="{{ route('friends.index', ['tab' => 'keluar']) }}" class="btn btn-secondary">Permintaan Keluar</a>
    </div>

    @if($tab == 'masuk')
        <h3>Data Permintaan Masuk</h3>
        @if($friends->isEmpty())
            <p>Tidak ada permintaan masuk.</p>
        @else
            @endif
    @else
        <h3>Data Permintaan Keluar</h3>
        @if($friends->isEmpty())
            <p>Tidak ada permintaan keluar.</p>
        @else
            @endif
    @endif

@endsection