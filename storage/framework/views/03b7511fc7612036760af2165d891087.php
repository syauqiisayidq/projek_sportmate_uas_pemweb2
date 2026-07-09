<?php $__env->startSection('title', 'Buat Event - SportMate'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="text-xl font-bold text-navy mb-4">Buat Event</h1>

    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('events.store')); ?>" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 border border-slate-100 space-y-4 max-w-xl">
        <?php echo csrf_field(); ?>
        <div>
            <label class="text-sm font-medium text-slate-600">Foto Event</label>
            <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Nama Event</label>
            <input type="text" name="nama_event" value="<?php echo e(old('nama_event')); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Masukan nama event">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Jenis Olahraga</label>
            <select name="sport_id" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary">
                <option value="">Pilih olahraga</option>
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sport->id); ?>" <?php echo e(old('sport_id') == $sport->id ? 'selected' : ''); ?>><?php echo e($sport->nama_sport); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="text-sm font-medium text-slate-600">Tanggal</label>
                <input type="text" id="tanggal" name="tanggal" value="<?php echo e(old('tanggal')); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary bg-white cursor-pointer text-xs" placeholder="Pilih">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Jam Mulai</label>
                <input type="time" name="jam" value="<?php echo e(old('jam')); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary text-xs">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="<?php echo e(old('jam_selesai')); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary text-xs">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Lokasi</label>
            <input type="text" name="lokasi" value="<?php echo e(old('lokasi')); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Tempat lokasi event">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Kuota Peserta</label>
            <input type="number" name="kuota" min="1" value="<?php echo e(old('kuota')); ?>" required class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Masukan batas jumlah peserta">
        </div>
        <div>
            <label class="text-sm font-medium text-slate-600">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="mt-1 w-full rounded-xl border-slate-200 focus:border-primary focus:ring-primary" placeholder="Yuk olahraga bersama untuk hidup lebih sehat!"><?php echo e(old('deskripsi')); ?></textarea>
        </div>
        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition">Publikasikan Event</button>
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#tanggal", {
            dateFormat: "Y-m-d",
            minDate: "today",
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/events/create.blade.php ENDPATH**/ ?>