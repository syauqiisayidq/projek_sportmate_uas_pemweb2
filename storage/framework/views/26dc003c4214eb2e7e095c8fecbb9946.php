
<?php $__env->startSection('title', 'Pilih Olahraga - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold text-navy mb-1">Pilih Olahraga Favoritmu 🏸</h1>
    <p class="text-slate-500 text-sm mb-6">Kami akan mencarikan teman dengan minat yang sama.</p>

    <?php if(session('status')): ?>
        <div class="mb-4 bg-primary/10 text-primary-dark px-4 py-3 rounded-xl text-sm"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('sports.save')); ?>" class="space-y-5">
        <?php echo csrf_field(); ?>
        <div class="grid grid-cols-3 gap-3">
            <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="cursor-pointer">
                    <input type="checkbox" name="sports[]" value="<?php echo e($sport->id); ?>" class="hidden peer"
                           <?php echo e(in_array($sport->id, $mySportIds) ? 'checked' : ''); ?>>
                    <div class="border border-slate-200 rounded-xl py-4 text-center peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:text-primary-dark transition">
                        <div class="text-sm font-semibold"><?php echo e($sport->nama_sport); ?></div>
                    </div>
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Jadwal biasa berolahraga</label>
            <input type="text" name="jadwal" placeholder="Contoh: Sabtu & Minggu" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">
            Simpan & Lanjutkan
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/sports/pick.blade.php ENDPATH**/ ?>