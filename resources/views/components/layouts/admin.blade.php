<x-layouts.app title="Admin SFStore">

    @php
        $menus = [
            ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard'],
            ['route' => 'admin.products', 'label' => 'Produk', 'icon' => 'products'],
            ['route' => 'admin.orders', 'label' => 'Pesanan', 'icon' => 'orders'],
            ['route' => 'admin.finance', 'label' => 'Keuangan', 'icon' => 'finance'],
            ['route' => 'admin.settings', 'label' => 'Pengaturan', 'icon' => 'settings'],
        ];

        $currentMenu = collect($menus)->first(fn($menu) => request()->routeIs($menu['route']));

        $pageTitle = $currentMenu['label'] ?? 'Dashboard';
    @endphp

    <div class="min-h-screen bg-slate-50" x-data="{ sidebarOpen: false }">

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden">
        </div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0">

            <!-- Brand -->
            <div class="flex h-20 items-center justify-between border-b border-white/10 px-6">

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-600 text-lg font-extrabold shadow-lg shadow-red-600/20">
                        SF
                    </div>

                    <div>
                        <h1 class="text-lg font-extrabold tracking-tight">
                            SFStore
                        </h1>

                        <p class="text-[11px] text-slate-400">
                            Admin Workspace
                        </p>
                    </div>
                </a>

                <button type="button" @click="sidebarOpen = false" aria-label="Tutup menu"
                    class="text-slate-400 lg:hidden">
                    ✕
                </button>

            </div>

            <!-- Sidebar Menu -->
            <div class="flex-1 overflow-y-auto px-4 py-6">

                <p class="mb-3 px-3 text-[11px] font-bold uppercase tracking-widest text-slate-500">
                    Menu Utama
                </p>

                <nav class="space-y-1">

                    @foreach ($menus as $menu)
                        @php
                            $active = request()->routeIs($menu['route']);
                        @endphp

                        <a href="{{ route($menu['route']) }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                           {{ $active
                               ? 'bg-red-600 text-white shadow-lg shadow-red-950/20'
                               : 'text-slate-400 hover:bg-white/10 hover:text-white' }}">

                            <!-- Menu Icon -->
                            @switch($menu['icon'])
                                @case('dashboard')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="7" height="7" rx="1" />
                                        <rect x="14" y="3" width="7" height="7" rx="1" />
                                        <rect x="3" y="14" width="7" height="7" rx="1" />
                                        <rect x="14" y="14" width="7" height="7" rx="1" />
                                    </svg>
                                @break

                                @case('products')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path d="M21 8l-9 5-9-5" />
                                        <path d="M3 8l9-5 9 5v9l-9 5-9-5z" />
                                        <path d="M12 13v9" />
                                    </svg>
                                @break

                                @case('orders')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path d="M4 7h16l-1 14H5L4 7z" />
                                        <path d="M9 9V6a3 3 0 016 0v3" />
                                    </svg>
                                @break

                                @case('finance')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <rect x="2" y="5" width="20" height="15" rx="2" />
                                        <path d="M2 10h20" />
                                        <path d="M16 15h2" />
                                    </svg>
                                @break

                                @default
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="3" />
                                        <path
                                            d="M12 2v2m0 16v2M4.9 4.9l1.4 1.4m11.4 11.4l1.4 1.4M2 12h2m16 0h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4" />
                                    </svg>
                            @endswitch

                            <span>{{ $menu['label'] }}</span>

                            @if ($active)
                                <span class="ml-auto h-1.5 w-1.5 rounded-full bg-white"></span>
                            @endif

                        </a>
                    @endforeach

                </nav>

                <div class="my-6 border-t border-white/10"></div>

                <p class="mb-3 px-3 text-[11px] font-bold uppercase tracking-widest text-slate-500">
                    Toko
                </p>

                <a href="/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm text-slate-400 transition hover:bg-white/10 hover:text-white">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M3 10l9-7 9 7v10H3z" />
                        <path d="M9 20v-7h6v7" />
                    </svg>

                    <span>Lihat Toko</span>
                    <span class="ml-auto">↗</span>
                </a>

            </div>

            <!-- Profile & Logout -->
            <div class="border-t border-white/10 p-4">

                <div class="mb-4 flex items-center gap-3 px-2">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-600 font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </p>

                        <p class="truncate text-xs text-slate-400">
                            {{ auth()->user()->email ?? 'Admin SFStore' }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf

                    <button type="submit"
                        class="flex w-full cursor-pointer items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-red-400 transition hover:bg-red-500/10 hover:text-red-300">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path d="M10 17l5-5-5-5" />
                            <path d="M15 12H3" />
                            <path d="M12 3h7a2 2 0 012 2v14a2 2 0 01-2 2h-7" />
                        </svg>

                        Keluar Akun
                    </button>
                </form>

            </div>

        </aside>

        <!-- Main Area -->
        <div class="min-w-0 lg:pl-64">

            <!-- Top Navbar -->
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">

                <div class="flex h-18 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

                    <div class="flex min-w-0 items-center gap-4">

                        <!-- Mobile Menu -->
                        <button type="button" @click="sidebarOpen = true" aria-label="Buka menu admin"
                            class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">
                                SFStore / Admin
                            </p>

                            <h2 class="truncate text-base font-bold text-slate-900 sm:text-lg">
                                {{ $pageTitle }}
                            </h2>
                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <a href="/" target="_blank" rel="noopener noreferrer"
                            class="hidden rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition hover:border-red-200 hover:text-red-600 sm:inline-flex">
                            Lihat Toko ↗
                        </a>

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50 text-sm font-bold text-red-600">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>

                    </div>

                </div>

            </header>

            <!-- Page Content -->
            <main class="min-h-[calc(100vh-72px)] p-4 sm:p-6 lg:p-8">

                <div class="mx-auto max-w-7xl">

                    <!-- Page Heading -->
                    <div class="mb-7">

                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                            {{ $pageTitle }}
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            Kelola aktivitas dan operasional SFStore.
                        </p>

                    </div>

                    <!-- Success Alert -->
                    @if (session('success'))
                        <div
                            class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            <span>✓</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <p class="font-semibold">
                                Terjadi kesalahan:
                            </p>

                            <ul class="mt-2 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Main Content Slot -->
                    {{ $slot }}

                </div>

            </main>

            <!-- Footer -->
            <footer class="border-t border-slate-200 bg-white px-4 py-5 sm:px-6 lg:px-8">

                <div class="flex flex-col justify-between gap-2 text-xs text-slate-500 sm:flex-row">

                    <p>
                        &copy; {{ date('Y') }} SFStore. All rights reserved.
                    </p>

                    <p>
                        SFStore Management System
                    </p>

                </div>

            </footer>

        </div>

    </div>

</x-layouts.app>
