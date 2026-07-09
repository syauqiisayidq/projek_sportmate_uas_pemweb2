<?php $__env->startSection('title', 'Kelola Events - SportMate Admin'); ?>
<?php $__env->startSection('content'); ?>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-navy">Events</h1>
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari event..." class="rounded-xl border-slate-200 text-sm focus:border-primary focus:ring-primary">
            <button class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-400">
                    <th class="p-4">Nama Event</th><th class="p-4">Pembuat</th><th class="p-4">Tanggal</th><th class="p-4">Peserta</th><th class="p-4">Status</th><th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t border-slate-50">
                        <td class="p-4 font-medium text-navy"><?php echo e($event->nama_event); ?></td>
                        <td class="p-4 text-slate-500"><?php echo e($event->creator->nama); ?></td>
                        <td class="p-4 text-slate-500"><?php echo e(\Carbon\Carbon::parse($event->tanggal)->format('d M Y')); ?></td>
                        <td class="p-4 text-slate-500"><?php echo e($event->participants_count); ?>/<?php echo e($event->kuota); ?></td>
                        <td class="p-4">
                            <form method="POST" action="<?php echo e(route('admin.events.status', $event)); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <select name="status" onchange="this.form.submit()" class="text-xs rounded-lg border-slate-200 focus:border-primary focus:ring-primary">
                                    <?php $__currentLoopData = ['upcoming','ongoing','completed','canceled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>" <?php echo e($event->status === $status ? 'selected' : ''); ?>><?php echo e(ucfirst($status)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-right">
                            <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>" onsubmit="return confirm('Hapus event ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-500 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($events->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/admin/events/index.blade.php ENDPATH**/ ?>