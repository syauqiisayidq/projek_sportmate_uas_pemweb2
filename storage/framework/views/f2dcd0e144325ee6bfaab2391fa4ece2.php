
<?php $__env->startSection('title', 'Laporan - SportMate Admin'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold text-navy mb-6">Laporan & Monitoring</h1>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-4">Olahraga Terpopuler</h3>
            <div class="space-y-3">
                <?php $__currentLoopData = $sportPopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600"><?php echo e($s->nama_sport); ?></span>
                        <span class="font-semibold text-primary-dark"><?php echo e($s->users_count); ?> peminat</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-4">Kota dengan Pengguna Terbanyak</h3>
            <div class="space-y-3">
                <?php $__currentLoopData = $kotaTerbanyak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600"><?php echo e($k->kota); ?></span>
                        <span class="font-semibold text-primary-dark"><?php echo e($k->total); ?> pengguna</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

<div class="bg-white rounded-2xl p-5 border border-slate-100 col-span-2">
            <h3 class="font-bold text-navy mb-4">Jumlah Event per Bulan</h3>
            
            <div class="flex items-end gap-3 h-48 pt-6"> <!-- Ditinggikan dikit biar lega -->
                <?php
                    $bulanLabel = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    $max = max(1, $eventPerBulan->max('total'));
                ?>
                
                <?php $__currentLoopData = $eventPerBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Tambahan h-full dan justify-end -->
                    <div class="flex-1 flex flex-col justify-end items-center gap-2 h-full">
                        
                        <!-- Area batas grafik -->
                        <div class="w-full h-full flex items-end">
                            <?php if($e->total > 0): ?>
                                <!-- Kalau ada data, tampilkan bar warna primer (hijau) -->
                                <div class="w-full bg-primary rounded-t-md relative group transition-all duration-300 hover:bg-opacity-80" 
                                     style="height: <?php echo e(max(5, ($e->total/$max)*100)); ?>%">
                                     <!-- Tooltip angka total saat di-hover -->
                                     <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                         <?php echo e($e->total); ?>

                                     </span>
                                </div>
                            <?php else: ?>
                                <!-- Kalau 0, bar-nya abu-abu tipis biar kelihatan tempatnya -->
                                <div class="w-full bg-slate-100 rounded-t-md" style="height: 5%"></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Label Bulan -->
                        <span class="text-xs font-medium <?php echo e($e->total > 0 ? 'text-slate-600' : 'text-slate-400'); ?>">
                            <?php echo e($bulanLabel[$e->bulan]); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>