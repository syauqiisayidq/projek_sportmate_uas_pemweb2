<?php $__env->startSection('title', $user->nama.' - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <a href="<?php echo e(route('explore.index')); ?>" class="text-sm text-slate-400 mb-4 inline-flex items-center gap-1">&larr; Detail Teman</a>

    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100">
        <div class="h-40 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>
        <div class="p-6 -mt-12">
            
            
            <img src="<?php echo e($user->foto_url); ?>" 
                 onclick="openExploreModal()"
                 class="w-24 h-24 rounded-2xl border-4 border-white object-cover shadow cursor-pointer hover:opacity-90 transition">
            
            <h1 class="text-xl font-bold text-navy mt-3"><?php echo e($user->nama); ?></h1>
            <p class="text-sm text-slate-400"><?php echo e($user->umur ?? '-'); ?> Tahun • <?php echo e($user->kota); ?></p>

            <div class="flex flex-wrap gap-2 mt-3">
                <?php $__currentLoopData = $user->sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="bg-primary/10 text-primary-dark text-xs font-semibold px-3 py-1 rounded-full"><?php echo e($sport->nama_sport); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-5 bg-slate-50 rounded-2xl p-4">
                <h3 class="font-bold text-navy text-sm mb-2">Jadwal Olahraga</h3>
                <?php $__empty_1 = true; $__currentLoopData = $user->sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex justify-between text-sm text-slate-500 py-1">
                        <span><?php echo e($sport->nama_sport); ?></span>
                        <span><?php echo e($sport->pivot->jadwal ?? '-'); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-slate-400">Belum ada jadwal.</p>
                <?php endif; ?>
            </div>

            <div class="mt-5">
                <h3 class="font-bold text-navy text-sm mb-2">Tentang Saya</h3>
                <p class="text-sm text-slate-500"><?php echo e($user->bio ?: 'Belum ada bio.'); ?></p>
            </div>

            <p class="text-xs text-emerald-500 font-semibold mt-4"><?php echo e($matchPercent); ?>% Match dengan minatmu</p>

            <div class="mt-6">
                <?php if($friendStatus === 'diterima'): ?>
                    <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-3 rounded-xl">Sudah Berteman</button>
                <?php elseif($friendStatus === 'pending'): ?>
                    <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-3 rounded-xl">Menunggu Respon</button>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('friends.request', $user)); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Tambah Teman</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div id="exploreLightbox" onclick="closeExploreModal()" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4">
        <div class="relative max-w-md w-full aspect-square bg-white rounded-3xl overflow-hidden p-2 shadow-2xl" onclick="event.stopPropagation()">
            <img src="<?php echo e($user->foto_url); ?>" class="w-full h-full rounded-2xl object-cover">
            <button onclick="closeExploreModal()" class="absolute top-4 right-4 bg-black/50 text-white hover:bg-black/70 w-8 h-8 rounded-full flex items-center justify-center font-bold transition">✕</button>
        </div>
    </div>

    
    <script>
        function openExploreModal() {
            const modal = document.getElementById('exploreLightbox');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeExploreModal() {
            const modal = document.getElementById('exploreLightbox');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/explore/show.blade.php ENDPATH**/ ?>