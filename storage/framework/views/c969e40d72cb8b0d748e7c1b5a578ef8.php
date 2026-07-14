

<?php $__env->startSection('title', 'Detail User - SportMate Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-navy">Detail User</h1>

    <a href="<?php echo e(route('admin.users.index')); ?>"
       class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium px-4 py-2 rounded-xl">
        ← Kembali
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 p-8">

    <div class="flex items-start gap-8">

        
        <div class="flex-shrink-0">
            <img src="<?php echo e($user->foto_url); ?>"
                 class="w-40 h-40 rounded-full object-cover border-4 border-primary">
        </div>

        
        <div class="grid grid-cols-2 gap-6 flex-1">

            <div>
                <p class="text-sm text-slate-400">Nama</p>
                <p class="font-semibold text-lg text-navy">
                    <?php echo e($user->nama); ?>

                </p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Email</p>
                <p class="font-semibold">
                    <?php echo e($user->email); ?>

                </p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Kota</p>
                <p><?php echo e($user->kota ?: '-'); ?></p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Gender</p>
                <p><?php echo e(ucfirst($user->gender) ?: '-'); ?></p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Tanggal Lahir</p>
                <p>
                    <?php echo e($user->tanggal_lahir ? $user->tanggal_lahir->format('d F Y') : '-'); ?>

                </p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Umur</p>
                <p><?php echo e($user->umur ? $user->umur.' Tahun' : '-'); ?></p>
            </div>

            <div>
                <p class="text-sm text-slate-400">Bergabung Sejak</p>
                <p><?php echo e($user->created_at->format('d F Y')); ?></p>
            </div>

        </div>

    </div>

    
    <div class="mt-10 border-t pt-8">

        <h2 class="font-bold text-lg text-navy mb-3">
            Bio
        </h2>

        <p class="text-slate-600 leading-relaxed">
            <?php echo e($user->bio ?: 'Belum memiliki bio.'); ?>

        </p>

    </div>

    
    <div class="mt-10 border-t pt-8">

        <h2 class="font-bold text-lg text-navy mb-4">
            Olahraga Dipilih
        </h2>

        <?php if($user->sports->count()): ?>

            <div class="flex flex-wrap gap-3">

                <?php $__currentLoopData = $user->sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <span class="bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium">
                        <?php echo e($sport->nama_sport); ?>

                    </span>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        <?php else: ?>

            <p class="text-slate-400">
                Belum memilih olahraga.
            </p>

        <?php endif; ?>

    </div>

    
    <div class="mt-10 border-t pt-8">

        <h2 class="font-bold text-lg text-navy mb-4">
            Event yang Diikuti
        </h2>

        <?php if($user->joinedEvents->count()): ?>

            <div class="space-y-3">

                <?php $__currentLoopData = $user->joinedEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="border border-slate-200 rounded-xl p-4">

                        <div class="font-semibold text-navy">
                            <?php echo e($event->nama_event); ?>

                        </div>

                        <div class="text-sm text-slate-500 mt-1">
                            Bergabung:
                            <?php echo e($event->pivot->joined_at
                                ? \Carbon\Carbon::parse($event->pivot->joined_at)->format('d M Y')
                                : '-'); ?>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        <?php else: ?>

            <p class="text-slate-400">
                Belum mengikuti event.
            </p>

        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/admin/users/show.blade.php ENDPATH**/ ?>