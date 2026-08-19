<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Kesalahan Server - Puri Agung Permai RW12</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
</head>
<body class="bg-gradient-to-br from-rose-50 via-white to-teal-50 min-h-screen flex items-center justify-center px-4">
    <div class="text-center max-w-lg">
        <div class="relative mb-8">
            <span class="text-[10rem] font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-rose-400 leading-none">500</span>
            <div class="absolute inset-0 flex items-center justify-center">
                <i data-lucide="server-crash" class="w-20 h-20 text-red-300/60"></i>
            </div>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4">Kesalahan Server</h1>
        <p class="text-slate-500 mb-8 text-lg">Terjadi kesalahan pada server kami. Tim teknis sedang menangani masalah ini.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-600 to-rose-700 text-white px-8 py-3.5 rounded-xl font-semibold hover:from-rose-700 hover:to-rose-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                <i data-lucide="home" class="w-5 h-5"></i>
                Kembali ke Beranda
            </a>
            <button onclick="location.reload()" class="inline-flex items-center gap-2 bg-white text-slate-700 px-8 py-3.5 rounded-xl font-semibold border border-slate-200 hover:bg-slate-50 transition-all duration-300 shadow-sm">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                Muat Ulang
            </button>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
<?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\errors\500.blade.php ENDPATH**/ ?>