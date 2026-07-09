<?php $__env->startSection('title', 'Events - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold text-navy">Events</h1>
        <a href="<?php echo e(route('events.create')); ?>" class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">+ Buat Event</a>
    </div>

    <form method="GET" class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-3 mb-4">
        <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="currentColor"><path d="M11 4a7 7 0 1 0 4.9 12l4.6 4.6 1.4-1.4-4.6-4.6A7 7 0 0 0 11 4Zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z"/></svg>
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari event..." class="flex-1 border-0 focus:ring-0 p-0 text-sm">
    </form>

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="<?php echo e(route('events.index')); ?>" class="px-4 py-1.5 rounded-full text-sm font-medium <?php echo e(!request('sport_id') ? 'bg-primary text-white' : 'bg-white text-slate-500 border border-slate-200'); ?>">Semua</a>
        <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('events.index', ['sport_id' => $sport->id])); ?>" class="px-4 py-1.5 rounded-full text-sm font-medium <?php echo e(request('sport_id') == $sport->id ? 'bg-primary text-white' : 'bg-white text-slate-500 border border-slate-200'); ?>"><?php echo e($sport->nama_sport); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <a href="<?php echo e(route('events.show', $event)); ?>" class="flex gap-4 bg-white rounded-2xl p-4 border border-slate-100 hover:shadow-md transition <?php echo e($event->status === 'canceled' ? 'opacity-65 grayscale bg-slate-50' : ''); ?>">
                
                <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex-shrink-0 flex items-center justify-center text-white text-xs font-bold text-center p-1">
                    <?php echo e($event->sport->nama_sport ?? ''); ?>

                </div>
                
                <div class="flex-1">
                    
                    <?php if($event->status === 'canceled'): ?>
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold">🔴 Canceled</span>
                    <?php elseif($event->status === 'ongoing'): ?>
                        <span class="text-xs bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full font-semibold">🟢 Ongoing</span>
                    <?php elseif($event->status === 'completed'): ?>
                        <span class="text-xs bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-semibold">🏁 Completed</span>
                    <?php else: ?>
                        <span class="text-xs bg-primary/10 text-primary-dark px-2 py-0.5 rounded-full font-semibold">Upcoming</span>
                    <?php endif; ?>

                    <h3 class="font-bold text-navy mt-1"><?php echo e($event->nama_event); ?></h3>
                    <p class="text-xs text-slate-400">📅 <?php echo e(\Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y')); ?> • <?php echo e(substr($event->jam, 0, 5)); ?> - <?php echo e(substr($event->jam_selesai, 0, 5)); ?></p>
                    <p class="text-xs text-slate-400">📍 <?php echo e($event->lokasi); ?></p>
                    
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-slate-400"><?php echo e($event->jumlah_peserta); ?>/<?php echo e($event->kuota); ?> peserta</span>
                        
                        
                        <?php if($event->status === 'canceled'): ?>
                            <span class="bg-slate-200 text-slate-500 text-xs font-semibold px-3 py-1 rounded-full">Detail</span>
                        <?php else: ?>
                            <span class="bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">Join</span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-2 bg-white rounded-2xl p-8 text-center text-slate-400 border border-slate-100">Belum ada event tersedia.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/events/index.blade.php ENDPATH**/ ?>