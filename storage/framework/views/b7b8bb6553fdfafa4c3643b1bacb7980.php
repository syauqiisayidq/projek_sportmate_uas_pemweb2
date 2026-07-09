<?php $__env->startSection('title', 'Home - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <div class="mb-6">
        <p class="text-slate-500 text-sm">Good Morning,</p>
        <h1 class="text-2xl font-bold text-navy"><?php echo e($user->nama); ?>! 👋</h1>
    </div>

    <a href="<?php echo e(route('explore.index')); ?>" class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-3 mb-6 text-slate-400 shadow-sm hover:border-primary transition">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
        Cari olahraga, teman, atau event...
    </a>

    <div class="grid grid-cols-5 gap-3 mb-8">
        <?php $__currentLoopData = ['Futsal' => 'M12 2a10 10 0 1 0 .1 20A10 10 0 0 0 12 2Z', 'Badminton' => 'M12 2 2 22h20L12 2Z', 'Basket' => 'M12 2a10 10 0 1 0 .1 20A10 10 0 0 0 12 2Z', 'Running' => 'M13 5a2 2 0 1 0-2-2 2 2 0 0 0 2 2Z', 'Cycling' => 'M5 17a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm14 0a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('explore.index', ['q' => $label])); ?>" class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary-dark">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="<?php echo e($icon); ?>"/></svg>
                </div>
                <span class="text-xs text-slate-500 font-medium"><?php echo e($label); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-navy">Upcoming Event</h2>
                    <a href="<?php echo e(route('events.index')); ?>" class="text-sm text-primary font-semibold">Lihat semua</a>
                </div>
                <?php if($upcomingEvent): ?>
                    <a href="<?php echo e(route('events.show', $upcomingEvent)); ?>" class="block bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100 hover:shadow-md transition">
                        <div class="h-32 bg-gradient-to-r from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-lg">
                            <?php echo e($upcomingEvent->sport->nama_sport ?? 'Event'); ?>

                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-navy"><?php echo e($upcomingEvent->nama_event); ?></h3>
                            <p class="text-xs text-slate-400 mt-1">📍 <?php echo e($upcomingEvent->lokasi); ?></p>
                            <p class="text-xs text-slate-400">🕗 <?php echo e(\Carbon\Carbon::parse($upcomingEvent->tanggal)->translatedFormat('l, d M Y')); ?> • <?php echo e(substr($upcomingEvent->jam,0,5)); ?> WIB</p>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xs bg-slate-100 px-2 py-1 rounded-full text-slate-500"><?php echo e($upcomingEvent->jumlah_peserta); ?>/<?php echo e($upcomingEvent->kuota); ?> peserta</span>
                                <span class="bg-primary text-white text-xs font-semibold px-4 py-1.5 rounded-full">Lihat Detail</span>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <div class="bg-white rounded-2xl p-6 text-center text-slate-400 text-sm border border-slate-100">Belum ada event mendatang.</div>
                <?php endif; ?>
            </div>

            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-navy">Rekomendasi Teman</h2>
                    <a href="<?php echo e(route('explore.index')); ?>" class="text-sm text-primary font-semibold">Lihat semua</a>
                </div>
                <div class="space-y-3">
                    <?php $__empty_1 = true; $__currentLoopData = $rekomendasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('explore.show', $rec)); ?>" class="flex items-center justify-between bg-white rounded-2xl p-3 border border-slate-100 hover:shadow-sm transition">
                            <div class="flex items-center gap-3">
                                <img src="<?php echo e($rec->foto_url); ?>" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <p class="font-semibold text-navy text-sm"><?php echo e($rec->nama); ?></p>
                                    <p class="text-xs text-slate-400"><?php echo e($rec->sports->pluck('nama_sport')->join(', ')); ?> • <?php echo e($rec->kota); ?></p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-primary"><?php echo e($rec->match_percent); ?>% Match</span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="bg-white rounded-2xl p-6 text-center text-slate-400 text-sm border border-slate-100">Belum ada rekomendasi teman. Pilih olahraga favoritmu dulu di profil.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <h3 class="font-bold text-navy mb-3">Statistik Kamu</h3>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div>
                        <p class="text-xl font-extrabold text-primary"><?php echo e($stats['teman']); ?></p>
                        <p class="text-xs text-slate-400">Teman</p>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-primary"><?php echo e($stats['event']); ?></p>
                        <p class="text-xs text-slate-400">Event</p>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-primary"><?php echo e($stats['aktivitas']); ?></p>
                        <p class="text-xs text-slate-400">Aktivitas</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <h3 class="font-bold text-navy mb-3">Hari Ini • <?php echo e(now()->translatedFormat('d M')); ?></h3>
                <?php $__empty_1 = true; $__currentLoopData = $todayEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('events.show', $ev)); ?>" class="flex items-center justify-between py-2 border-b last:border-0 border-slate-50">
                        <div>
                            <p class="text-sm font-semibold text-navy"><?php echo e($ev->nama_event); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e(substr($ev->jam,0,5)); ?> • <?php echo e($ev->lokasi); ?></p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M9 6l6 6-6 6"/></svg>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-slate-400">Tidak ada jadwal hari ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/dashboard.blade.php ENDPATH**/ ?>