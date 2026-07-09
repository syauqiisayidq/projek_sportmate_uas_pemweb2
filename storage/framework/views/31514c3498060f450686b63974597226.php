<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SportMate'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            fontFamily: { sans: ['Poppins', 'sans-serif'] },
            colors: { primary: { DEFAULT: '#10B981', dark: '#0E9F71', light: '#D1FAE5' }, navy: '#0F1E3D' }
        } } }
    </script>
    <style>body{font-family:'Poppins',sans-serif;}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden grid md:grid-cols-2">
        <div class="hidden md:flex flex-col justify-center gap-4 bg-primary/5 p-10">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white font-bold text-xl">S</div>
                <span class="text-2xl font-extrabold text-navy">SportMate</span>
            </div>
            <h2 class="text-2xl font-bold text-navy mt-4">Find your sport partner,<br>build healthy connections.</h2>
            <p class="text-slate-500 text-sm">Temukan teman olahraga sesuai minat, lokasi, dan jadwalmu. Buat event, gabung komunitas, dan tetap aktif bersama SportMate.</p>
            <div class="flex gap-3 mt-6 text-primary">
                <svg class="w-16 h-16 opacity-30" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                <svg class="w-16 h-16 opacity-20" viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="2" width="20" height="20" rx="6"/></svg>
            </div>
        </div>
        <div class="p-8 md:p-10 flex flex-col justify-center">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\sportmate_pemwebII-main\sportmate\resources\views/layouts/guest.blade.php ENDPATH**/ ?>