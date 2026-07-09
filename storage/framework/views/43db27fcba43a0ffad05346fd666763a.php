<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SportMate'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        primary: { DEFAULT: '#10B981', dark: '#0E9F71', light: '#D1FAE5' },
                        navy: '#0F1E3D',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; background:#F4F7F6; }
        ::-webkit-scrollbar { width: 6px; } ::-webkit-scrollbar-thumb { background:#c9d6d2; border-radius:4px; }
    </style>
</head>
<body class="min-h-screen text-slate-800">

<div class="flex min-h-screen">
    
    <aside class="hidden md:flex md:flex-col w-64 bg-white border-r border-slate-100 fixed h-full">
        <div class="px-6 py-6 flex items-center gap-2 border-b border-slate-100">
            <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-white font-bold text-lg">S</div>
            <span class="text-xl font-extrabold text-navy">SportMate</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1">
            <?php
                $navItems = [
                    ['route' => 'dashboard', 'label' => 'Home', 'icon' => 'home'],
                    ['route' => 'explore.index', 'label' => 'Cari Teman', 'icon' => 'search'],
                    ['route' => 'events.index', 'label' => 'Events', 'icon' => 'calendar'],
                    ['route' => 'friends.index', 'label' => 'Teman', 'icon' => 'users'],
                    ['route' => 'profile.riwayat', 'label' => 'Riwayat', 'icon' => 'clock'],
                    ['route' => 'profile.show', 'label' => 'Profil Saya', 'icon' => 'user'],
                ];
                $icons = [
                    'home' => 'M3 9.5 12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5Z',
                    'search' => 'M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z',
                    'calendar' => 'M7 2v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7Zm12 8H5v10h14V10Z',
                    'users' => 'M16 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm-8 0a3.5 3.5 0 1 0-3.5-3.5A3.5 3.5 0 0 0 8 11Zm0 2c-2.7 0-8 1.3-8 4v3h9.3a5.9 5.9 0 0 1-.3-2c0-2 1-3.6 2.3-4.8A16 16 0 0 0 8 13Zm8 0c-.6 0-1.3.05-2 .14C15.2 14.2 16 15.9 16 18v2h8v-3c0-2.7-5.3-4-8-4Z',
                    'clock' => 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm1 5v5.6l4 2.3-1 1.7-5-2.9V7Z',
                    'user' => 'M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.4 0-8 2.2-8 5v3h16v-3c0-2.8-3.6-5-8-5Z',
                ];
            ?>
            <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route($item['route'])); ?>"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition
                   <?php echo e(request()->routeIs($item['route']) || (str($item['route'])->contains('profile') && request()->routeIs('profile.*'))
                        ? 'bg-primary/10 text-primary-dark' : 'text-slate-500 hover:bg-slate-50'); ?>">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="<?php echo e($icons[$item['icon']]); ?>"/></svg>
                    <?php echo e($item['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <a href="<?php echo e(route('events.create')); ?>" class="flex items-center justify-center gap-2 mt-4 bg-primary text-white rounded-xl py-2.5 font-semibold text-sm shadow-sm hover:bg-primary-dark transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11 5h2v6h6v2h-6v6h-2v-6H5v-2h6z"/></svg>
                Buat Event
            </a>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-4 py-2.5 mt-2 rounded-xl text-sm font-medium text-navy bg-slate-50 hover:bg-slate-100">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 3 6v6c0 5 3.8 9.4 9 10 5.2-.6 9-5 9-10V6l-9-4Z"/></svg>
                        Admin Panel
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
        <div class="p-4 border-t border-slate-100">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M10 17v-2H3v-2h7V9l5 4-5 4Zm9 2H12v-2h7V7h-7V5h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2Z"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    
    <div class="md:hidden fixed top-0 inset-x-0 bg-white border-b border-slate-100 flex items-center justify-between px-4 py-3 z-30">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-bold">S</div>
            <span class="font-extrabold text-navy">SportMate</span>
        </div>
        <a href="<?php echo e(route('profile.show')); ?>">
            <img src="<?php echo e(auth()->user()->foto_url); ?>" class="w-8 h-8 rounded-full object-cover">
        </a>
    </div>

    <main class="flex-1 md:ml-64 pt-16 md:pt-0 pb-20 md:pb-0">
        <div class="max-w-6xl mx-auto p-4 md:p-8">
            <?php if(session('status')): ?>
                <div class="mb-4 bg-primary/10 text-primary-dark border border-primary/20 px-4 py-3 rounded-xl text-sm font-medium">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm font-medium">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
</div>


<div class="md:hidden fixed bottom-0 inset-x-0 bg-white border-t border-slate-100 flex items-center justify-around py-2 z-30">
    <a href="<?php echo e(route('dashboard')); ?>" class="p-2 <?php echo e(request()->routeIs('dashboard') ? 'text-primary' : 'text-slate-400'); ?>">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M3 9.5 12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5Z"/></svg>
    </a>
    <a href="<?php echo e(route('explore.index')); ?>" class="p-2 <?php echo e(request()->routeIs('explore.*') ? 'text-primary' : 'text-slate-400'); ?>">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
    </a>
    <a href="<?php echo e(route('events.create')); ?>" class="p-3 bg-primary rounded-full text-white -mt-6 shadow-lg">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11 5h2v6h6v2h-6v6h-2v-6H5v-2h6z"/></svg>
    </a>
    <a href="<?php echo e(route('events.index')); ?>" class="p-2 <?php echo e(request()->routeIs('events.*') ? 'text-primary' : 'text-slate-400'); ?>">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7Zm12 8H5v10h14V10Z"/></svg>
    </a>
    <a href="<?php echo e(route('profile.show')); ?>" class="p-2 <?php echo e(request()->routeIs('profile.*') ? 'text-primary' : 'text-slate-400'); ?>">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.4 0-8 2.2-8 5v3h16v-3c0-2.8-3.6-5-8-5Z"/></svg>
    </a>
</div>

</body>
</html>
<?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/layouts/app.blade.php ENDPATH**/ ?>