<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SportMate')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            fontFamily: { sans: ['Poppins', 'sans-serif'] },
            colors: { primary: { DEFAULT: '#10B981', dark: '#0E9F71', light: '#D1FAE5' }, navy: '#0F1E3D' }
        } } }
    </script>
    <style>body{font-family:'Poppins',sans-serif;background:#F4F7F6;}</style>
</head>
<body class="min-h-screen text-slate-800">
<div class="flex min-h-screen">
    <aside class="w-64 bg-navy text-white flex flex-col fixed h-full">
        <div class="px-6 py-6 flex items-center gap-2 border-b border-white/10">
            <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-white font-bold text-lg">S</div>
            <div>
                <p class="font-extrabold leading-none">SportMate</p>
                <p class="text-xs text-white/50">Admin</p>
            </div>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            @php
                $items = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                    ['route' => 'admin.users.index', 'label' => 'Users'],
                    ['route' => 'admin.sports.index', 'label' => 'Sports'],
                    ['route' => 'admin.events.index', 'label' => 'Events'],
                    ['route' => 'admin.reports.index', 'label' => 'Reports'],
                ];
            @endphp
            @foreach($items as $item)
                <a href="{{ route($item['route']) }}" class="block px-4 py-2.5 rounded-xl font-medium transition {{ request()->routeIs($item['route']) ? 'bg-primary text-white' : 'text-white/60 hover:bg-white/5' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-white/10 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl text-white/60 hover:bg-white/5 text-sm">Kembali ke User</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2.5 rounded-xl text-red-300 hover:bg-white/5 text-sm">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        @if(session('status'))
            <div class="mb-4 bg-primary/10 text-primary-dark border border-primary/20 px-4 py-3 rounded-xl text-sm font-medium">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
