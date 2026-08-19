<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(asset('images/hero/logo_puri.png')); ?>">
    <title><?php echo $__env->yieldContent('title', config('app.name', 'RW 012')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-rose-900 via-rose-800 to-rose-900 p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-3">
                <img src="<?php echo e(asset('images/hero/logo_puri.png')); ?>" alt="Logo Puri Agung Permai RW12" class="w-12 h-12 object-contain">
                <span class="text-2xl font-bold text-white tracking-tight">Puri Agung Permai <span class="text-rose-300">RW12</span></span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl shadow-black/10 p-8">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <p class="text-center mt-6 text-sm text-white/60">&copy; <?php echo e(date('Y')); ?> Puri Agung Permai RW12. All rights reserved.</p>
    </div>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>lucide.createIcons();</script>
</body>
</html>
<?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views/layouts/guest.blade.php ENDPATH**/ ?>