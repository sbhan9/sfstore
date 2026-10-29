<x-layouts.app title="Login Admin SFStore">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-50 px-4 py-10">

        {{-- Background dekoratif --}}
        <div class="pointer-events-none absolute -left-24 -top-24 h-72 w-72 rounded-full bg-red-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-orange-200/40 blur-3xl">
        </div>

        <div
            class="relative grid w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl shadow-slate-200/70 lg:grid-cols-2">

            {{-- Panel kiri: Branding --}}
            <div
                class="relative hidden flex-col justify-between overflow-hidden bg-gradient-to-br from-red-600 via-red-600 to-rose-800 p-10 text-white lg:flex xl:p-14">

                <div class="absolute -right-20 top-20 h-64 w-64 rounded-full border border-white/10"></div>
                <div class="absolute -right-10 top-32 h-44 w-44 rounded-full border border-white/10"></div>
                <div class="absolute -bottom-28 -left-16 h-72 w-72 rounded-full bg-white/5"></div>

                <a href="/" class="relative flex items-center gap-3">
                    <span
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-xl font-black text-red-600 shadow-lg">
                        S
                    </span>
                    <span class="text-2xl font-black tracking-tight">SFStore</span>
                </a>

                <div class="relative my-12">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold tracking-wide">
                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                        ADMIN DASHBOARD
                    </span>

                    <h1 class="mt-7 text-4xl font-black leading-tight xl:text-5xl">
                        Kelola toko.<br>
                        Kembangkan bisnis.
                    </h1>

                    <p class="mt-5 max-w-sm text-sm leading-7 text-red-100">
                        Selamat datang di pusat pengelolaan SFStore.
                        Masuk untuk mengelola produk, pesanan, dan aktivitas toko.
                    </p>
                </div>

                <div
                    class="relative flex items-center justify-between border-t border-white/20 pt-6 text-xs text-red-100">
                    <span>© {{ date('Y') }} SFStore</span>
                    <span>Admin Portal</span>
                </div>
            </div>

            {{-- Panel kanan: Form login --}}
            <div class="flex items-center justify-center p-6 sm:p-10 lg:p-12 xl:p-14">
                <div class="w-full max-w-md">

                    {{-- Logo mobile --}}
                    <a href="/" class="mb-8 flex items-center gap-3 lg:hidden">
                        <span
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-600 text-lg font-black text-white shadow-lg shadow-red-600/20">
                            S
                        </span>
                        <span class="text-2xl font-black tracking-tight text-slate-900">SFStore</span>
                    </a>

                    <div class="mb-8">
                        <p class="mb-3 text-sm font-bold uppercase tracking-[0.2em] text-red-600">
                            Admin Area
                        </p>

                        <h2 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                            Selamat datang!
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Masuk menggunakan akun administrator untuk melanjutkan.
                        </p>
                    </div>

                    {{-- Pesan error --}}
                    @if ($errors->any())
                        <div role="alert"
                            class="mb-6 flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 8v4m0 4h.01" />
                            </svg>
                            <div>
                                <p class="font-bold">Login gagal</p>
                                <p class="mt-1">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                                Email administrator
                            </label>

                            <div class="relative">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <path d="m3 7 9 6 9-6" />
                                    </svg>
                                </span>

                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    placeholder="admin@contoh.com" autocomplete="username" required autofocus
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-red-500 focus:bg-white focus:ring-4 focus:ring-red-500/10">
                            </div>
                        </div>

                        {{-- Password --}}
                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label for="password" class="text-sm font-bold text-slate-700">
                                    Password
                                </label>
                            </div>

                            <div class="relative">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <rect x="4" y="10" width="16" height="11" rx="2" />
                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                        <path d="M12 14v3" />
                                    </svg>
                                </span>

                                <input id="password" type="password" name="password" placeholder="Masukkan password"
                                    autocomplete="current-password" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-14 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-red-500 focus:bg-white focus:ring-4 focus:ring-red-500/10">

                                <button type="button" id="togglePassword" aria-label="Tampilkan password"
                                    aria-pressed="false"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-red-600 focus:outline-none focus-visible:text-red-600">
                                    {{-- Ikon mata --}}
                                    <svg id="eyeIcon" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>

                                    {{-- Ikon mata dicoret --}}
                                    <svg id="eyeOffIcon" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path d="m3 3 18 18" />
                                        <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8" />
                                        <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a17 17 0 0 1-3.1 3.8" />
                                        <path d="M6.6 6.7C3.6 8.5 2 12 2 12s3.6 7 10 7c1.1 0 2.1-.2 3-.6" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Tombol login --}}
                        <button type="submit"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-red-600/20 transition duration-200 hover:-translate-y-0.5 hover:bg-red-700 hover:shadow-xl hover:shadow-red-600/25 focus:outline-none focus:ring-4 focus:ring-red-500/20 active:translate-y-0">
                            Masuk ke Dashboard
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14m-7-7 7 7-7 7" />
                            </svg>
                        </button>
                    </form>

                    <div class="my-7 flex items-center gap-4">
                        <div class="h-px flex-1 bg-slate-200"></div>
                        <span class="text-xs text-slate-400">AREA ADMINISTRATOR</span>
                        <div class="h-px flex-1 bg-slate-200"></div>
                    </div>

                    <a href="/"
                        class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="m15 18-6-6 6-6" />
                            <path d="M9 12h12" />
                            <path d="M4 4v16" />
                        </svg>
                        Kembali ke toko
                    </a>

                    <p class="mt-8 text-center text-xs leading-5 text-slate-400">
                        Halaman khusus administrator SFStore.<br>
                        Akses hanya untuk pengguna yang berwenang.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript tampil/sembunyikan password --}}
    <script>
        (() => {
            const initPasswordToggle = () => {
                const password = document.getElementById('password');
                const toggle = document.getElementById('togglePassword');
                const eyeIcon = document.getElementById('eyeIcon');
                const eyeOffIcon = document.getElementById('eyeOffIcon');

                if (!password || !toggle || toggle.dataset.initialized) return;

                toggle.dataset.initialized = 'true';

                toggle.addEventListener('click', () => {
                    const isHidden = password.type === 'password';

                    password.type = isHidden ? 'text' : 'password';
                    eyeIcon.classList.toggle('hidden', isHidden);
                    eyeOffIcon.classList.toggle('hidden', !isHidden);
                    toggle.setAttribute('aria-pressed', String(isHidden));
                    toggle.setAttribute(
                        'aria-label',
                        isHidden ? 'Sembunyikan password' : 'Tampilkan password'
                    );
                });
            };

            initPasswordToggle();
        })();
    </script>
</x-layouts.app>
