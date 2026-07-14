<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin - SportMate'); ?></title>
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

              <!-- Logo -->

            <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shadow">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-7 h-7 text-white"
                     fill="currentColor"
                     viewBox="0 0 24 24">

                    <path d="M12 2C8 2 4.7 5.3 4.7 9.4c0 5.2 7.3 12.6 7.3 12.6s7.3-7.4 7.3-12.6C19.3 5.3 16 2 12 2zm0 10a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z"/>

                </svg>

            </div>

            <div>
                <p class="font-extrabold leading-0">SportMate</p>
                <p class="text-xs text-white/50">Admin</p>
            </div>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            <?php
                $items = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                    ['route' => 'admin.users.index', 'label' => 'Users'],
                    ['route' => 'admin.sports.index', 'label' => 'Sports'],
                    ['route' => 'admin.events.index', 'label' => 'Events'],
                    ['route' => 'admin.reports.index', 'label' => 'Reports'],
                ];
            ?>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route($item['route'])); ?>" class="block px-4 py-2.5 rounded-xl font-medium transition <?php echo e(request()->routeIs($item['route']) ? 'bg-primary text-white' : 'text-white/60 hover:bg-white/5'); ?>">
                    <?php echo e($item['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
        <div class="p-4 border-t border-white/10 space-y-1">
            <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2.5 rounded-xl text-white/60 hover:bg-white/5 text-sm">Kembali ke User</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="w-full text-left px-4 py-2.5 rounded-xl text-red-300 hover:bg-white/5 text-sm">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <?php if(session('status')): ?>
            <div class="mb-4 bg-primary/10 text-primary-dark border border-primary/20 px-4 py-3 rounded-xl text-sm font-medium"><?php echo e(session('status')); ?></div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>
</body>
</html>
<?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/layouts/admin.blade.php ENDPATH**/ ?>