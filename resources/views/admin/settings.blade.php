<x-layouts.admin>

    <!-- Header -->
    <div class="mb-8">
        <p class="mb-2 text-xs font-bold uppercase tracking-widest text-red-600">
            Store Configuration
        </p>

        <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
            Pengaturan Toko
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Kelola identitas dan informasi kontak bisnis SFStore.
        </p>
    </div>

    <div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-3">

        <!-- Main Form -->
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6 xl:col-span-2">

            @csrf

            <!-- Store Identity -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 sm:px-6">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path d="M3 10l2-6h14l2 6" />
                            <path d="M3 10h18v10H3z" />
                            <path d="M9 20v-7h6v7" />
                        </svg>

                    </div>

                    <div>
                        <h3 class="font-bold text-slate-900">
                            Identitas Toko
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Informasi utama bisnis digital lu.
                        </p>
                    </div>

                </div>

                <div class="space-y-5 p-5 sm:p-6">

                    <!-- Store Name -->
                    <div>
                        <label for="shop_name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Toko <span class="text-red-600">*</span>
                        </label>

                        <input type="text" id="shop_name" name="shop_name" required maxlength="100"
                            value="{{ old('shop_name', $shop) }}" placeholder="Contoh: SFStore"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">

                        @error('shop_name')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-xs text-slate-400">
                            Nama ini digunakan sebagai identitas toko.
                        </p>
                    </div>

                </div>

            </section>

            <!-- WhatsApp Settings -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5 sm:px-6">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path
                                d="M21 11.5a8.4 8.4 0 0 1-.9 3.8A8.5 8.5 0 0 1 12.5 20a8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 12.5 3 8.5 8.5 0 0 1 21 11.5z" />
                        </svg>

                    </div>

                    <div>
                        <h3 class="font-bold text-slate-900">
                            WhatsApp Bisnis
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Nomor tujuan checkout pelanggan.
                        </p>
                    </div>

                </div>

                <div class="space-y-5 p-5 sm:p-6">

                    <!-- WhatsApp -->
                    <div>
                        <label for="wa_number" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nomor WhatsApp <span class="text-red-600">*</span>
                        </label>

                        <div
                            class="flex overflow-hidden rounded-xl border border-slate-200 focus-within:border-red-500 focus-within:ring-2 focus-within:ring-red-100">

                            <div
                                class="flex items-center border-r border-slate-200 bg-slate-50 px-4 text-sm font-semibold text-slate-600">
                                WA
                            </div>

                            <input type="tel" id="wa_number" name="wa_number" required inputmode="numeric"
                                pattern="62[0-9]{7,13}" title="Gunakan format 62 diikuti 7 sampai 13 digit nomor"
                                value="{{ old('wa_number', $wa) }}" placeholder="6281234567890"
                                class="min-w-0 w-full border-0 px-4 py-3 text-sm text-slate-900 outline-none">

                        </div>

                        @error('wa_number')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-xs text-slate-400">
                            Gunakan format internasional, contoh 6281234567890.
                            Tanpa tanda +, spasi, atau awalan 0.
                        </p>
                    </div>

                    <!-- WhatsApp Info -->
                    <div class="rounded-xl border border-green-100 bg-green-50 p-4">

                        <div class="flex items-start gap-3">

                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-700" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M5 12l4 4L19 6" />
                            </svg>

                            <p class="text-xs leading-relaxed text-green-800">
                                Nomor ini digunakan untuk mengarahkan pelanggan
                                ke WhatsApp setelah membuat pesanan.
                                Data order tetap dicatat di dashboard admin.
                            </p>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Save Button -->
            <div
                class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">

                <p class="text-xs text-slate-500">
                    Pastikan seluruh informasi sudah benar.
                </p>

                <button type="submit"
                    class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-red-600 bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-red-600">

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12l4 4L19 6" />
                    </svg>

                    Simpan Pengaturan
                </button>

            </div>

        </form>

        <!-- Sidebar Info -->
        <aside class="space-y-6">

            <!-- Store Preview -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <h3 class="font-bold text-slate-900">
                    Preview Toko
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Identitas toko yang saat ini tersimpan.
                </p>

                <div class="mt-5 flex items-center gap-3 rounded-xl bg-slate-50 p-4">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-600 text-base font-extrabold text-white">
                        SF
                    </div>

                    <div class="min-w-0">

                        <p class="truncate font-bold text-slate-900">
                            {{ $shop }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Digital Product Store
                        </p>

                    </div>

                </div>

                <div class="mt-5 space-y-3 border-t border-slate-100 pt-5">

                    <div>
                        <p class="text-xs text-slate-400">
                            WhatsApp Checkout
                        </p>

                        <p class="mt-1 break-all text-sm font-semibold text-slate-700">
                            +{{ $wa }}
                        </p>
                    </div>

                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex w-full items-center justify-center rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700 transition hover:bg-green-100">
                        Tes WhatsApp ↗
                    </a>

                </div>

            </div>

            <!-- Security Reminder -->
            <div class="rounded-2xl border border-amber-100 bg-amber-50 p-5">

                <h3 class="text-sm font-bold text-amber-900">
                    Perhatikan Nomor WhatsApp
                </h3>

                <p class="mt-2 text-xs leading-relaxed text-amber-800">
                    Pastikan nomor WhatsApp yang digunakan aktif
                    dan dapat menerima pesan pelanggan.
                    Kesalahan nomor dapat membuat pelanggan
                    mengirim pesanan ke tujuan yang salah.
                </p>

            </div>

        </aside>

    </div>

</x-layouts.admin>
