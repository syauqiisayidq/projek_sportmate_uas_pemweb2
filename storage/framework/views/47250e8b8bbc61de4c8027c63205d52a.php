
<?php $__env->startSection('title', 'Dashboard Admin - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold text-navy mb-6">Dashboard</h1>

    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-navy rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-white"><?php echo e($totalUsers); ?></p>
            <p class="text-xs text-slate-400">Total Users</p>
        </div>
        <div class="bg-navy rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-white"><?php echo e($totalEvents); ?></p>
            <p class="text-xs text-slate-400">Total Events</p>
        </div>
        <div class="bg-navy rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-white"><?php echo e($totalFriendRequests); ?></p>
            <p class="text-xs text-slate-400">Friend Requests</p>
        </div>
        <div class="bg-navy rounded-2xl p-5 border border-slate-100">
            <p class="text-2xl font-extrabold text-white"><?php echo e($activeUsers); ?></p>
            <p class="text-xs text-slate-400">Active Users</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <p class="font-semibold text-navy mb-4">Aktivitas Mingguan</p>
            <svg viewBox="0 0 320 140" class="w-full h-36">
                
            <?php
    $max = max(1, $aktivitasMingguan->max('total'));

    $points = $aktivitasMingguan->values()->map(function ($d, $i) use ($max) {
        $x = 20 + ($i * 50);
        $y = 120 - (($d['total'] / $max) * 100);

        return "$x,$y";
    })->implode(' ');
?>

<polyline
    points="<?php echo e($points); ?>"
    fill="none"
    stroke="#108961"
    stroke-width="3"
    stroke-linecap="round"
    stroke-linejoin="round"/>

<?php $__currentLoopData = $aktivitasMingguan->values(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <circle
        cx="<?php echo e(20 + ($i * 50)); ?>"
        cy="<?php echo e(120 - (($d['total'] / $max) * 100)); ?>"
        r="4"
        fill="#108961" />

    <text
        x="<?php echo e(20 + ($i * 50)); ?>"
        y="135"
        font-size="10"
        text-anchor="middle"
        fill="#94a3b8">
        <?php echo e($d['label']); ?>

    </text>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </svg>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="font-bold text-navy mb-3">Event Terbaru</h3>
            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $eventTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-xs">🏆</span>
                        <div>
                            <p class="font-medium text-navy"><?php echo e($e->nama_event); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e(\Carbon\Carbon::parse($e->tanggal)->format('d M Y')); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-slate-400">Belum ada event.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-slate-100 mt-4">
        <h3 class="font-bold text-navy mb-3">Pengguna Terbaru</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="pb-2">Nama</th><th class="pb-2">Email</th><th class="pb-2">Kota</th><th class="pb-2">Bergabung</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $penggunaTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-slate-50 last:border-0">
                        <td class="py-2 font-medium text-navy"><?php echo e($u->nama); ?></td>
                        <td class="py-2 text-slate-500"><?php echo e($u->email); ?></td>
                        <td class="py-2 text-slate-500"><?php echo e($u->kota); ?></td>
                        <td class="py-2 text-slate-500"><?php echo e($u->created_at->format('d M Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>