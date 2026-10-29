<x-layouts.admin>

    <!-- Header -->
    <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-widest text-red-600">
                Product Management
            </p>

            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                Kelola Produk
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Kelola katalog, harga, dan status produk SFStore.
            </p>
        </div>

        <a href="{{ route('admin.product.create') }}"
            class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-red-600 bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-red-600">

            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14" />
            </svg>

            Tambah Produk
        </a>

    </div>

    <!-- Product List -->
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <!-- Section Header -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-5 sm:px-6">

            <div>
                <h3 class="font-bold text-slate-900">
                    Daftar Produk
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Semua produk yang tersimpan di katalog.
                </p>
            </div>

            <span class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600">
                {{ $products->total() }} Produk
            </span>

        </div>

        <!-- Desktop Table -->
        <div class="hidden overflow-x-auto md:block">

            <table class="w-full min-w-[800px] text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Produk</th>
                        <th class="px-5 py-4 font-semibold">Harga Jual</th>
                        <th class="px-5 py-4 font-semibold">Modal</th>
                        <th class="px-5 py-4 font-semibold">Status</th>
                        <th class="px-5 py-4 font-semibold">Rekomendasi</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($products as $p)
                        <tr class="transition hover:bg-slate-50">

                            <!-- Product -->
                            <td class="px-6 py-4">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-red-50">

                                        @if ($p->image)
                                            <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                                                class="h-full w-full object-cover" loading="lazy">
                                        @else
                                            <svg class="h-6 w-6 text-red-400" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path d="M21 8l-9 5-9-5" />
                                                <path d="M3 8l9-5 9 5v9l-9 5-9-5z" />
                                                <path d="M12 13v9" />
                                            </svg>
                                        @endif

                                    </div>

                                    <div class="min-w-0">

                                        <p class="max-w-[240px] truncate font-semibold text-slate-900"
                                            title="{{ $p->name }}">
                                            {{ $p->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $p->category }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- Price -->
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="font-bold text-slate-900">
                                    Rp{{ number_format($p->price, 0, ',', '.') }}
                                </span>

                                @if ($p->compare_price && $p->compare_price > $p->price)
                                    <p class="mt-1 text-xs text-slate-400 line-through">
                                        Rp{{ number_format($p->compare_price, 0, ',', '.') }}
                                    </p>
                                @endif
                            </td>

                            <!-- Cost -->
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                Rp{{ number_format($p->cost, 0, ',', '.') }}
                            </td>

                            <!-- Status -->
                            <td class="px-5 py-4">

                                @if ($p->active)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Nonaktif
                                    </span>
                                @endif

                            </td>

                            <!-- Featured -->
                            <td class="px-5 py-4">

                                @if ($p->featured)
                                    <span
                                        class="inline-flex rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                        ★ Unggulan
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">
                                        Reguler
                                    </span>
                                @endif

                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route('admin.product.edit', $p) }}" title="Edit produk"
                                        aria-label="Edit {{ $p->name }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-600 hover:text-white">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                            viewBox="0 0 24 24">
                                            <path d="M12 20h9" />
                                            <path d="M16 4l4 4-12 12H4v-4z" />
                                        </svg>

                                    </a>

                                    <form action="{{ route('admin.product.delete', $p) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" title="Hapus produk"
                                            aria-label="Hapus {{ $p->name }}"
                                            class="inline-flex h-9 w-9 cursor-pointer items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition hover:bg-red-50 hover:text-red-600">

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                                viewBox="0 0 24 24">
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="M6 6l1 15h10l1-15" />
                                                <path d="M10 10v7M14 10v7" />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <p class="font-semibold text-slate-700">
                                    Belum ada produk
                                </p>
                                <p class="mt-2 text-xs text-slate-400">
                                    Tambahkan produk pertama SFStore.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Mobile Product Cards -->
        <div class="divide-y divide-slate-100 md:hidden">

            @forelse ($products as $p)
                <article class="p-4">

                    <div class="flex items-start gap-3">

                        <!-- Image -->
                        <div
                            class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-red-50">

                            @if ($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                                    class="h-full w-full object-cover" loading="lazy">
                            @else
                                <svg class="h-7 w-7 text-red-400" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="M21 8l-9 5-9-5" />
                                    <path d="M3 8l9-5 9 5v9l-9 5-9-5z" />
                                    <path d="M12 13v9" />
                                </svg>
                            @endif

                        </div>

                        <!-- Product Info -->
                        <div class="min-w-0 flex-1">

                            <h3 class="break-words text-sm font-bold text-slate-900">
                                {{ $p->name }}
                            </h3>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $p->category }}
                            </p>

                            <p class="mt-2 text-base font-extrabold text-red-600">
                                Rp{{ number_format($p->price, 0, ',', '.') }}
                            </p>

                            @if ($p->compare_price && $p->compare_price > $p->price)
                                <p class="text-xs text-slate-400 line-through">
                                    Rp{{ number_format($p->compare_price, 0, ',', '.') }}
                                </p>
                            @endif

                        </div>

                    </div>

                    <!-- Status -->
                    <div class="mt-3 flex flex-wrap items-center gap-2">

                        <span
                            class="rounded-full px-3 py-1 text-xs font-semibold
                            {{ $p->active ? 'bg-green-50 text-green-700' : 'bg-slate-100 text-slate-600' }}">

                            {{ $p->active ? 'Aktif' : 'Nonaktif' }}

                        </span>

                        @if ($p->featured)
                            <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                ★ Rekomendasi
                            </span>
                        @endif

                        <span class="text-xs text-slate-400">
                            Modal: Rp{{ number_format($p->cost, 0, ',', '.') }}
                        </span>

                    </div>

                    <!-- Actions -->
                    <div class="mt-4 grid grid-cols-2 gap-2">

                        <a href="{{ route('admin.product.edit', $p) }}"
                            class="flex items-center justify-center gap-2 rounded-xl border border-red-600 bg-red-600 px-3 py-2.5 text-sm font-semibold text-white transition hover:bg-transparent hover:text-red-600">
                            Edit Produk
                        </a>

                        <form method="POST" action="{{ route('admin.product.delete', $p) }}"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-full cursor-pointer rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">
                                Hapus
                            </button>

                        </form>

                    </div>

                </article>

            @empty

                <div class="px-5 py-14 text-center">
                    <p class="font-semibold text-slate-700">
                        Belum ada produk
                    </p>
                    <p class="mt-2 text-sm text-slate-400">
                        Produk yang ditambahkan akan muncul di sini.
                    </p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $products->links() }}
            </div>
        @endif

    </section>

</x-layouts.admin>
