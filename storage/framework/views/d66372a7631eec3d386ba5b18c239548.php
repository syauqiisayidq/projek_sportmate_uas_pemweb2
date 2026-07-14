
<?php $__env->startSection('title', 'Kelola Sports - SportMate Admin'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold text-navy mb-6">Sports</h1>

    <form method="POST" action="<?php echo e(route('admin.sports.store')); ?>" class="flex gap-2 mb-6">
        <?php echo csrf_field(); ?>
        <input type="text" name="nama_sport" placeholder="Nama olahraga baru" required class="flex-1 rounded-xl border-slate-200 text-sm focus:border-primary focus:ring-primary">
        <button class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">Tambah</button>
    </form>

    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-400"><th class="p-4">Nama Olahraga</th><th class="p-4">Jumlah Peminat</th><th class="p-4 text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t border-slate-50">
                        <td class="p-4">
                            <form method="POST" action="<?php echo e(route('admin.sports.update', $sport)); ?>" id="form-sport-<?php echo e($sport->id); ?>" class="flex items-center gap-2">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="text" name="nama_sport" value="<?php echo e($sport->nama_sport); ?>" class="border-0 bg-transparent font-medium text-navy focus:ring-1 focus:ring-primary rounded">
                            </form>
                        </td>
                        <td class="p-4 text-slate-500"><?php echo e($sport->users_count); ?></td>
                        <td class="p-4 text-right">
                            <button type="submit" form="form-sport-<?php echo e($sport->id); ?>" class="text-primary text-xs font-semibold mr-3">Simpan</button>
                            <form method="POST" action="<?php echo e(route('admin.sports.destroy', $sport)); ?>" onsubmit="return confirm('Hapus olahraga <?php echo e($sport->nama_sport); ?>?')" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-500 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/admin/sports/index.blade.php ENDPATH**/ ?>