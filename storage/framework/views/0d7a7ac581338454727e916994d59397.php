<?php $__env->startSection('title', $event->nama_event.' - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <a href="<?php echo e(route('events.index')); ?>" class="text-sm text-slate-400 mb-4 inline-flex items-center gap-1">&larr; Detail Event</a>

    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 max-w-2xl">
        <div class="h-44 bg-gradient-to-r from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-2xl font-bold">
            <?php echo e($event->sport->nama_sport ?? ''); ?>

        </div>
        <div class="p-6">
            
            <?php if($event->status === 'canceled'): ?>
                <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">Canceled</span>
            <?php else: ?>
                <span class="text-xs bg-primary/10 text-primary-dark px-2 py-0.5 rounded-full font-semibold"><?php echo e(ucfirst($event->status)); ?></span>
            <?php endif; ?>

            <h1 class="text-xl font-bold text-navy mt-2"><?php echo e($event->nama_event); ?></h1>
            <p class="text-sm text-slate-400 flex items-center gap-2 mt-1">
                <img src="<?php echo e($event->creator->foto_url); ?>" class="w-5 h-5 rounded-full">
                Dibuat oleh <?php echo e($event->creator->nama); ?>

            </p>

            <div class="grid grid-cols-2 gap-4 mt-5">
                <div>
                    <p class="text-xs text-slate-400">Tanggal</p>
                    <p class="text-sm font-semibold text-navy"><?php echo e(\Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d M Y')); ?></p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Jam</p>
                    
                    <p class="text-sm font-semibold text-navy"><?php echo e(substr($event->jam,0,5)); ?> - <?php echo e(substr($event->jam_selesai,0,5)); ?> WIB</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-slate-400">Lokasi</p>
                    <p class="text-sm font-semibold text-navy"><?php echo e($event->lokasi); ?></p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-slate-400">Kuota Peserta</p>
                    <p class="text-sm font-semibold text-navy"><?php echo e($event->joinedUsers->count()); ?> / <?php echo e($event->kuota); ?></p>
                </div>
            </div>

            <div class="mt-5">
                <p class="text-xs text-slate-400 mb-1">Deskripsi</p>
                <p class="text-sm text-slate-600"><?php echo e($event->deskripsi ?: '-'); ?></p>
            </div>

            <div class="mt-5">
                <p class="text-xs text-slate-400 mb-2">Peserta (<?php echo e($event->joinedUsers->count()); ?>)</p>
                <div class="flex -space-x-2">
                    <?php $__currentLoopData = $event->joinedUsers->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($p->foto_url); ?>" title="<?php echo e($p->nama); ?>" class="w-9 h-9 rounded-full border-2 border-white object-cover">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="mt-6">
                
                <?php if($event->user_id === Auth::id()): ?>
                    
                    
                    <?php if($event->status === 'canceled'): ?>
                        <div class="w-full bg-red-50 text-red-600 text-center font-semibold py-3 rounded-xl border border-red-200 shadow-sm">
                            🔴 Event Ini Telah Anda Batalkan
                        </div>
                    
                    <?php else: ?>
                        <form method="POST" action="<?php echo e(route('events.cancel', $event)); ?>" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan event ini, Bung?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-xl transition shadow-sm text-center">
                                🔴 Batalkan Event Ini
                            </button>
                        </form>
                    <?php endif; ?>

                <?php else: ?>
                    
                    <?php if($event->status === 'canceled'): ?>
                        <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-3 rounded-xl cursor-not-allowed">Event Dibatalkan oleh Penyelenggara</button>
                    <?php elseif($isJoined): ?>
                        <form method="POST" action="<?php echo e(route('events.leave', $event)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="w-full bg-slate-100 text-slate-500 font-semibold py-3 rounded-xl">Keluar dari Event</button>
                        </form>
                    <?php elseif($event->isFull()): ?>
                        <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-3 rounded-xl">Kuota Penuh</button>
                    <?php else: ?>
                        <form method="POST" action="<?php echo e(route('events.join', $event)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Join Event</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/events/show.blade.php ENDPATH**/ ?>