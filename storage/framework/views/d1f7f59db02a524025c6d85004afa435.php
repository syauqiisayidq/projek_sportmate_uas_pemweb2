<?php $__env->startSection('title', 'Cari Teman - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-xl font-bold text-navy mb-4">Explore (Cari Teman)</h1>

    <form method="GET" class="space-y-3 mb-6">
        <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-3">
            <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari teman olahraga..." class="flex-1 border-0 focus:ring-0 p-0 text-sm">
            <button class="text-primary text-sm font-semibold">Cari</button>
        </div>
        <div class="flex flex-wrap gap-2">
            <select name="sport_id" onchange="this.form.submit()" class="rounded-full text-sm border-slate-200 focus:border-primary focus:ring-primary">
                <option value="">Semua Olahraga</option>
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sport->id); ?>" <?php echo e(request('sport_id') == $sport->id ? 'selected' : ''); ?>><?php echo e($sport->nama_sport); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="text" name="kota" value="<?php echo e(request('kota')); ?>" placeholder="Lokasi/Kota" class="rounded-full text-sm border-slate-200 focus:border-primary focus:ring-primary">
        </div>
    </form>

    <div class="grid md:grid-cols-2 gap-4">
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('explore.show', $u)); ?>" class="flex items-center gap-3 bg-white rounded-2xl p-4 border border-slate-100 hover:shadow-md transition">
                <img src="<?php echo e($u->foto_url); ?>" class="w-16 h-16 rounded-xl object-cover">
                <div class="flex-1">
                    <p class="font-bold text-navy"><?php echo e($u->nama); ?></p>
                    <p class="text-xs text-slate-400"><?php echo e($u->umur ?? '-'); ?> Tahun • <?php echo e($u->kota); ?></p>
                    <p class="text-xs text-primary-dark font-medium"><?php echo e($u->sports->pluck('nama_sport')->join(', ') ?: 'Belum ada minat'); ?></p>
                    <p class="text-xs text-emerald-500 font-semibold"><?php echo e($u->match_percent); ?>% Match</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-lg font-bold">
                    <?php echo e($u->friend_status === 'diterima' ? '✓' : '+'); ?>

                </span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-2 bg-white rounded-2xl p-8 text-center text-slate-400 border border-slate-100">Tidak ada pengguna ditemukan.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/explore/index.blade.php ENDPATH**/ ?>