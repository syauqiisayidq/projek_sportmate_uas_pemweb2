
<?php $__env->startSection('title', 'Kelola Users - SportMate Admin'); ?>
<?php $__env->startSection('content'); ?>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-navy">Users</h1>
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari nama/email..." class="rounded-xl border-slate-200 text-sm focus:border-primary focus:ring-primary">
            <button class="bg-primary text-white text-sm font-semibold px-4 py-2 rounded-xl">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr class="text-left text-slate-400">   
                <th class="p-4">Foto</th>
                <th class="p-4">Nama</th>
                <th class="p-4">Email</th>
                <th class="p-4">Kota</th>
                <th class="p-4">Olahraga</th>
                <th class="p-4">Event Diikuti</th>
                <th class="p-4 text-right">Aksi</th>
            </tr>
                
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t border-slate-50">

    <td class="p-4">
        <?php if($u->foto): ?>
            <img src="<?php echo e(asset('storage/' . $u->foto)); ?>"
                 class="w-12 h-12 rounded-full object-cover">
        <?php else: ?>
            <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold">
                <?php echo e(strtoupper(substr($u->nama,0,1))); ?>

            </div>
        <?php endif; ?>
    </td>

    <td class="p-4 font-medium text-navy">
        <?php echo e($u->nama); ?>

    </td>

    <td class="p-4 text-slate-500">
        <?php echo e($u->email); ?>

    </td>

    <td class="p-4 text-slate-500">
        <?php echo e($u->kota ?? '-'); ?>

    </td>

    <td class="p-4 text-slate-500">
        <?php echo e($u->sports_count); ?>

    </td>

    <td class="p-4 text-slate-500">
        <?php echo e($u->joined_events_count); ?>

    </td>

    <td class="p-4 text-right">

        <a href="<?php echo e(route('admin.users.show',$u)); ?>"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-2 rounded-lg">
            Detail
        </a>

        <form method="POST"
              action="<?php echo e(route('admin.users.destroy',$u)); ?>"
              class="inline-block"
              onsubmit="return confirm('Hapus pengguna ini?')">

            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded-lg">
                Hapus
            </button>

        </form>

    </td>

</tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($users->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/admin/users/index.blade.php ENDPATH**/ ?>