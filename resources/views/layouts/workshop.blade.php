<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Workshop System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#0f172a] font-['Outfit',sans-serif] selection:bg-blue-500/30 selection:text-blue-200 text-slate-200">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 lg:px-8 pointer-events-none mt-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between pointer-events-auto bg-slate-900/60 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl px-6 py-4">
            <!-- Logo/Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group" wire:navigate>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-emerald-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-300">
                    W
                </div>
                <span class="text-xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-300 hidden sm:block">
                    Workshop<span class="text-blue-400">Hub</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-sm font-medium transition-all duration-300 transform hover:-translate-y-0.5 text-slate-200 shadow-lg" wire:navigate>
                        {{ auth()->user()->is_admin ? 'ระบบจัดการ (Admin)' : 'เวิร์กชอปของฉัน' }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-xl bg-white text-slate-900 hover:bg-slate-200 text-sm font-bold shadow-lg shadow-white/10 transition-all duration-300 transform hover:-translate-y-0.5" wire:navigate>
                        เข้าสู่ระบบแอดมิน
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-28">
        {{ $slot }}
    </div>

    @livewireScripts
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:confirm', (data) => {
                let params = data;
                if (Array.isArray(params)) {
                    while (Array.isArray(params) && params.length > 0) {
                        params = params[0];
                    }
                } else if (params && params.detail) {
                    params = params.detail;
                    while (Array.isArray(params) && params.length > 0) {
                        params = params[0];
                    }
                }

                const isDark = document.documentElement.classList.contains('dark');
                Swal.fire({
                    title: params.title,
                    text: params.text,
                    icon: params.icon || 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: params.confirmText || 'ยืนยัน',
                    cancelButtonText: params.cancelText || 'ยกเลิก',
                    background: isDark ? '#1e293b' : '#ffffff',
                    color: isDark ? '#f8fafc' : '#0f172a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (params.params !== undefined) {
                            Livewire.dispatch(params.method, params.params);
                        } else {
                            Livewire.dispatch(params.method);
                        }
                    }
                });
            });

            Livewire.on('swal:alert', (data) => {
                let params = data;
                if (Array.isArray(params)) {
                    while (Array.isArray(params) && params.length > 0) {
                        params = params[0];
                    }
                } else if (params && params.detail) {
                    params = params.detail;
                    while (Array.isArray(params) && params.length > 0) {
                        params = params[0];
                    }
                }

                const isDark = document.documentElement.classList.contains('dark');
                Swal.fire({
                    title: params.title,
                    text: params.text,
                    icon: params.icon || 'success',
                    confirmButtonText: 'ตกลง',
                    background: isDark ? '#1e293b' : '#ffffff',
                    color: isDark ? '#f8fafc' : '#0f172a'
                });
            });
        });
    </script>
</body>
</html>
