<?php $__env->startSection('title', 'Profil Saya - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <div class="max-w-xl">
        <div class="bg-primary rounded-3xl p-6 text-white text-center relative">
            <a href="<?php echo e(route('profile.edit')); ?>" class="absolute right-5 top-5 text-white/80 text-sm">Edit</a>
            
            
            <img src="<?php echo e($user->foto_url); ?>" 
                 onclick="openPhotoModal()"
                 class="w-20 h-20 rounded-full mx-auto border-4 border-white/40 object-cover cursor-pointer hover:opacity-90 transition">
            
            <h1 class="font-bold text-lg mt-3"><?php echo e($user->nama); ?></h1>
            <p class="text-white/80 text-sm"><?php echo e($user->kota); ?></p>
            <?php if($user->bio): ?>
                <span class="inline-block bg-white/20 text-xs font-semibold px-3 py-1 rounded-full mt-2"><?php echo e($user->bio); ?></span>
            <?php endif; ?>
            <div class="grid grid-cols-3 gap-2 mt-5 bg-white/10 rounded-2xl p-4">
                <div><p class="text-xl font-extrabold"><?php echo e($stats['teman']); ?></p><p class="text-xs text-white/70">Teman</p></div>
                <div><p class="text-xl font-extrabold"><?php echo e($stats['event']); ?></p><p class="text-xs text-white/70">Event</p></div>
                <div><p class="text-xl font-extrabold"><?php echo e($stats['aktivitas']); ?></p><p class="text-xs text-white/70">Aktivitas</p></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl mt-4 border border-slate-100 divide-y divide-slate-50">
            <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Edit Profil <span class="text-slate-300">›</span>
            </a>
            <a href="<?php echo e(route('sports.pick')); ?>" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Olahraga Favorit <span class="text-slate-300">›</span>
            </a>
            <a href="<?php echo e(route('profile.riwayat')); ?>" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Riwayat Aktivitas <span class="text-slate-300">›</span>
            </a>
            <a href="<?php echo e(route('friends.index')); ?>" class="flex items-center justify-between p-4 text-sm font-medium text-navy">
                Teman & Pertemanan <span class="text-slate-300">›</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl mt-4 p-4 border border-slate-100">
            <h3 class="font-bold text-navy text-sm mb-2">Olahraga Favorit</h3>
            <div class="flex flex-wrap gap-2">
                <?php $__empty_1 = true; $__currentLoopData = $user->sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <span class="bg-primary/10 text-primary-dark text-xs font-semibold px-3 py-1 rounded-full"><?php echo e($sport->nama_sport); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-slate-400">Belum memilih olahraga favorit.</p>
                <?php endif; ?>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-4">
            <?php echo csrf_field(); ?>
            <button class="w-full text-red-500 font-semibold py-3 rounded-xl bg-white border border-red-100">Keluar</button>
        </form>

        
        <div id="photoLightbox" onclick="closePhotoModal()" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4">
            <div class="relative max-w-md w-full aspect-square bg-white rounded-3xl overflow-hidden p-2 shadow-2xl" onclick="event.stopPropagation()">
                <img src="<?php echo e($user->foto_url); ?>" class="w-full h-full rounded-2xl object-cover">
                <button onclick="closePhotoModal()" class="absolute top-4 right-4 bg-black/50 text-white hover:bg-black/70 w-8 h-8 rounded-full flex items-center justify-center font-bold transition">✕</button>
            </div>
        </div>
    </div>

    
    <script>
        function openPhotoModal() {
            const modal = document.getElementById('photoLightbox');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closePhotoModal() {
            const modal = document.getElementById('photoLightbox');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/profile/show.blade.php ENDPATH**/ ?>