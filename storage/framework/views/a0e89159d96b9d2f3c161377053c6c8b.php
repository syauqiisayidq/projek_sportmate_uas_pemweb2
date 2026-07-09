<?php $__env->startSection('title', 'Edit Profil - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-xl font-bold text-navy mb-4">Edit Profil</h1>

    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm max-w-xl">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 border border-slate-100 space-y-4 max-w-xl">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="flex items-center gap-4">
            <img src="<?php echo e($user->foto_url); ?>" class="w-16 h-16 rounded-full object-cover">
            <div class="flex-1">
                <label class="text-sm font-medium text-slate-600">Foto Profil</label>
                <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Nama</label>
            <input type="text" name="nama" value="<?php echo e(old('nama', $user->nama)); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-sm font-medium text-slate-600">Jenis Kelamin</label>
                <select name="gender" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
                    <option value="Laki-laki" <?php echo e($user->gender === 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo e($user->gender === 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d'))); ?>" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Kota</label>
            <input type="text" name="kota" value="<?php echo e(old('kota', $user->kota)); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Bio</label>
            <textarea name="bio" rows="2" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary"><?php echo e(old('bio', $user->bio)); ?></textarea>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-sm font-medium text-slate-600">Password Baru (opsional)</label>
                <input type="password" name="password" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Konfirmasi</label>
                <input type="password" name="password_confirmation" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
            </div>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Simpan Perubahan</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/profile/edit.blade.php ENDPATH**/ ?>