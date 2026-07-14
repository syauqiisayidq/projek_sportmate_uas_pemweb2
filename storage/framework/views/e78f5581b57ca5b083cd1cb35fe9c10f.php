
<?php $__env->startSection('title', 'Daftar - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold text-navy mb-1">Buat Akun Baru 🏃</h1>
    <p class="text-slate-500 text-sm mb-6">Gabung SportMate dan temukan teman olahragamu.</p>

    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            <label class="text-sm font-medium text-slate-600">Nama Lengkap</label>
            <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" required
                   class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Nama kamu">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                   class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="nama@email.com">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-sm font-medium text-slate-600">Jenis Kelamin</label>
                <select name="gender" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Tanggal Lahir</label>
                <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>" placeholder="Pilih tanggal lahir" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary text-sm text-slate-600">
            </div>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script>
                flatpickr("#tanggal_lahir", {
                    dateFormat: "Y-m-d", // Format standar database Laravel
                    maxDate: "today",    // Mencegah user memilih tanggal masa depan
                });
            </script>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Kota</label>
            <input type="text" name="kota" value="<?php echo e(old('kota')); ?>" required
                   class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Asal kota kamu">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="text-sm font-medium text-slate-600">Password</label>
                <input type="password" name="password" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Masukan password">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Konfirmasi</label>
                <input type="password" name="password_confirmation" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Konfirmasi password">
            </div>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">
            Daftar
        </button>
    </form>

    <p class="text-sm text-slate-500 mt-6 text-center">
        Sudah punya akun? <a href="<?php echo e(route('login')); ?>" class="text-primary font-semibold">Masuk</a>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/auth/register.blade.php ENDPATH**/ ?>