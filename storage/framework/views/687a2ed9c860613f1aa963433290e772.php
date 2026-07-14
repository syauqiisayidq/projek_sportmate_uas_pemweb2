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
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        primary: '#16A34A',
                        navy: '#0F172A'
                    }
                }
            }
        }
    </script>

    <style>
        body{
            font-family:'Poppins',sans-serif;
        }
    </style>

</head>

<body class="min-h-screen bg-gradient-to-br from-green-400 via-white to-emerald-500">

<div class="min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-5xl bg-white rounded-[32px] overflow-hidden shadow-2xl grid lg:grid-cols-2">

   <!-- LEFT -->

<div class="relative hidden lg:flex flex-col justify-between overflow-hidden bg-gradient-to-br from-green-50 to-white p-10">

    <!-- Background Image -->
    <div class="absolute inset-0">

        <img
            src="<?php echo e(asset('images/login-illustration.png')); ?>"
            class="absolute bottom-0 left-0 w-full object-cover opacity-20 pointer-events-none select-none">

        <div class="absolute inset-0 bg-gradient-to-t from-green-50 via-transparent to-transparent"></div>

    </div>

    <div class="relative z-10">

        <!-- Logo -->

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shadow">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-7 h-7 text-white"
                     fill="currentColor"
                     viewBox="0 0 24 24">

                    <path d="M12 2C8 2 4.7 5.3 4.7 9.4c0 5.2 7.3 12.6 7.3 12.6s7.3-7.4 7.3-12.6C19.3 5.3 16 2 12 2zm0 10a2.8 2.8 0 100-5.6 2.8 2.8 0 000 5.6z"/>

                </svg>

            </div>

            <span class="text-3xl font-extrabold text-navy">

                SportMate

            </span>

        </div>

        <!-- Judul -->

        <h1 class="text-4xl font-extrabold text-navy leading-tight mt-8">

            <span class="text-primary">

                Find your sport partner

            </span>

            <br>

            build healty connections.


        </h1>

        <!-- Deskripsi -->

        <p class="text-slate-500 text-base leading-6 mt-3 max-w-md">

            Temukan teman olahraga sesuai minat, lokasi, dan jadwalmu.
            Buat event, gabung komunitas, dan tetap aktif bersama SportMate.

        </p>

        <!-- Card -->

        <div class="grid grid-cols-3 gap-4 mt-10 max-w-md">

            <div class="bg-white rounded-2xl shadow-lg p-4 text-center">

                <div class="text-3xl">👥</div>

                <p class="font-semibold mt-2 text-sm">

                    Teman

                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-lg p-4 text-center">

                <div class="text-3xl">📅</div>

                <p class="font-semibold mt-2 text-sm">

                    Event

                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-lg p-4 text-center">

                <div class="text-3xl">🛡️</div>

                <p class="font-semibold mt-2 text-sm">

                    Komunitas

                </p>

            </div>

        </div>

    </div>

</div>

    <!-- RIGHT -->

    <div class="p-10 flex items-center">

        <div class="w-full">

            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </div>

</div>

</div>

</body>
</html><?php /**PATH C:\laragon\www\projek_sportmate_uas_pemweb2\resources\views/layouts/guest.blade.php ENDPATH**/ ?>