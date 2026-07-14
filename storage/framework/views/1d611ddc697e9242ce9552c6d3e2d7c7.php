
<?php $__env->startSection('title', 'Login - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold text-navy mb-2">
    Selamat Datang Kembali 👋🏻
    </h1>

    <p class="text-slate-500 mb-1">
    Masuk untuk melanjutkan pencarian teman olahragamu.
    </p>

    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            <label class="text-sm font-medium text-slate-600">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                   class="mt-2 w-full rounded-xl border border-slate-200 px-2 py-1 focus:ring-2 focus:ring-primary focus:border-primary">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Password</label>
            <input type="password" name="password" required
                   class="mt-2 w-full rounded-xl border-slate-200 px-2 py-1 focus:ring-primary" placeholder="••••••••">
        </div>
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-slate-500">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary focus:ring-primary">
                Ingat saya
            </label>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">
            Masuk
        </button>
    </form>

    <p class="text-sm text-slate-500 mt-6 text-center">
        Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-primary font-semibold">Daftar sekarang</a>
    </p>

    
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/auth/login.blade.php ENDPATH**/ ?>