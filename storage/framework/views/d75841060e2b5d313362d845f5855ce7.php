<?php $__env->startSection('title', 'Riwayat Aktivitas - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-xl font-bold text-navy mb-4">Riwayat Aktivitas</h1>

    <div class="mb-6">
        <h2 class="font-bold text-navy text-sm mb-3">Event yang Diikuti</h2>
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('events.show', $r->event)); ?>" class="flex items-center gap-3 bg-white rounded-2xl p-3 border border-slate-100">
                    <div class="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center text-primary-dark text-lg">🏃</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-navy">Bergabung di event <?php echo e($r->event->nama_event); ?></p>
                        <p class="text-xs text-slate-400"><?php echo e($r->joined_at?->translatedFormat('d M Y, H:i')); ?> WIB</p>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-6">Belum ada riwayat event.</p>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <h2 class="font-bold text-navy text-sm mb-3">Teman Olahraga</h2>
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $pertemanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $lawan = $f->pengirim_id === auth()->id() ? $f->penerima : $f->pengirim; ?>
                <div class="flex items-center gap-3 bg-white rounded-2xl p-3 border border-slate-100">
                    <img src="<?php echo e($lawan->foto_url); ?>" class="w-11 h-11 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-navy">Menambahkan teman baru <?php echo e($lawan->nama); ?></p>
                        <p class="text-xs text-slate-400"><?php echo e($f->updated_at->translatedFormat('d M Y, H:i')); ?> WIB</p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-6">Belum ada riwayat pertemanan.</p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/profile/riwayat.blade.php ENDPATH**/ ?>