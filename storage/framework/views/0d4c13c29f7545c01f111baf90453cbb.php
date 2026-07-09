<?php $__env->startSection('title', 'Teman - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-xl font-bold text-navy mb-4">Teman</h1>

    <div>
        <div class="flex gap-6 border-b border-slate-100 mb-4 text-sm font-semibold">
            <button onclick="showTab('permintaan')" id="tab-permintaan" class="pb-3 text-primary border-b-2 border-primary">Permintaan (<?php echo e($pending->count()); ?>)</button>
            <button onclick="showTab('pending')" id="tab-pending" class="pb-3 text-slate-400">Terkirim (<?php echo e($sentPending->count()); ?>)</button>
            <button onclick="showTab('teman')" id="tab-teman" class="pb-3 text-slate-400">Teman (<?php echo e($friends->count()); ?>)</button>
        </div>

        
        <div id="panel-permintaan" class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100">
                    
                    <a href="<?php echo e(route('explore.show', $p->pengirim)); ?>" class="flex items-center gap-3 flex-1 hover:opacity-80 transition">
                        <img src="<?php echo e($p->pengirim->foto_url); ?>" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-navy text-sm"><?php echo e($p->pengirim->nama); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e($p->pengirim->umur ?? '-'); ?> Tahun • <?php echo e($p->pengirim->kota); ?></p>
                        </div>
                    </a>
                    <div class="flex gap-2">
                        <form method="POST" action="<?php echo e(route('friends.accept', $p)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="bg-primary text-white text-xs font-semibold px-4 py-2 rounded-lg">Terima</button>
                        </form>
                        <form method="POST" action="<?php echo e(route('friends.reject', $p)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="bg-slate-100 text-slate-500 text-xs font-semibold px-4 py-2 rounded-lg">Tolak</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-8">Tidak ada permintaan pertemanan.</p>
            <?php endif; ?>
        </div>

        
        <div id="panel-pending" class="space-y-3 hidden">
            <?php $__empty_1 = true; $__currentLoopData = $sentPending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100">
                    <a href="<?php echo e(route('explore.show', $p->penerima)); ?>" class="flex items-center gap-3 flex-1 hover:opacity-80 transition">
                        <img src="<?php echo e($p->penerima->foto_url); ?>" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-navy text-sm"><?php echo e($p->penerima->nama); ?></p>
                            <p class="text-xs text-slate-400">Menunggu respon</p>
                        </div>
                    </a>
                    <form method="POST" action="<?php echo e(route('friends.cancel', $p)); ?>">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="bg-slate-100 text-slate-500 text-xs font-semibold px-4 py-2 rounded-lg">Batalkan</button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-8">Belum ada permintaan terkirim.</p>
            <?php endif; ?>
        </div>

        
        <div id="panel-teman" class="space-y-3 hidden">
            <?php $__empty_1 = true; $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100">
                    <a href="<?php echo e(route('explore.show', $f)); ?>" class="flex items-center gap-3 flex-1 hover:opacity-80 transition">
                        <img src="<?php echo e($f->foto_url); ?>" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-navy text-sm"><?php echo e($f->nama); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e($f->umur ?? '-'); ?> Tahun • <?php echo e($f->kota); ?></p>
                        </div>
                    </a>
                    <form method="POST" action="<?php echo e(route('friends.destroy', $f->id)); ?>" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertemanan dengan <?php echo e($f->nama); ?>?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-500 hover:text-red-600 bg-red-50 hover:bg-red-100 text-xs font-semibold px-3 py-2 rounded-xl transition">
                            Hapus Teman
                        </button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-8">Belum ada teman. Yuk cari teman baru!</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function showTab(name) {
            ['permintaan', 'pending', 'teman'].forEach(t => {
                document.getElementById('panel-' + t).classList.toggle('hidden', t !== name);
                document.getElementById('tab-' + t).classList.toggle('text-primary', t === name);
                document.getElementById('tab-' + t).classList.toggle('border-b-2', t === name);
                document.getElementById('tab-' + t).classList.toggle('border-primary', t === name);
                document.getElementById('tab-' + t).classList.toggle('text-slate-400', t !== name);
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/friends/index.blade.php ENDPATH**/ ?>