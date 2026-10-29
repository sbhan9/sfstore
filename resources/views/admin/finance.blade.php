<x-layouts.admin>

    @php
        $profit = $revenue - $cost - $expenseTotal;

        $stats = [
            [
                'title' => 'Penjualan Lunas',
                'value' => $revenue,
                'description' => 'Total pembayaran diterima',
                'icon' => 'sales',
            ],
            [
                'title' => 'Modal Produk Terjual',
                'value' => $cost,
                'description' => 'Modal dari produk terjual',
                'icon' => 'cost',
            ],
            [
                'title' => 'Pengeluaran',
                'value' => $expenseTotal,
                'description' => 'Total biaya operasional',
                'icon' => 'expense',
            ],
            [
                'title' => 'Estimasi Laba',
                'value' => $profit,
                'description' => 'Penjualan dikurangi biaya',
                'icon' => 'profit',
            ],
        ];
    @endphp

    <!-- Header -->
    <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-widest text-red-600">
                Financial Overview
            </p>

            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                Pencatatan Keuangan
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Kelola pendapatan, modal, dan pengeluaran bisnis SFStore.
            </p>
        </div>

        <div
            class="inline-flex items-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-medium text-slate-600">
            <span class="h-2 w-2 rounded-full bg-green-500"></span>
            Ringkasan Keuangan
        </div>
    </div>

    <!-- Financial Statistics -->
    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-5">

        @foreach ($stats as $stat)
            <div
                class="group min-w-0 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-red-200 hover:shadow-lg sm:p-5">

                <!-- Icon -->
                <div
                    class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600 transition group-hover:bg-red-600 group-hover:text-white">

                    @switch($stat['icon'])
                        @case('sales')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M3 17l6-6 4 4 8-8" />
                                <path d="M15 7h6v6" />
                            </svg>
                        @break

                        @case('cost')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M21 8l-9 5-9-5" />
                                <path d="M3 8l9-5 9 5v9l-9 5-9-5z" />
                                <path d="M12 13v9" />
                            </svg>
                        @break

                        @case('expense')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M6 2h12v20l-3-2-3 2-3-2-3 2z" />
                                <path d="M9 8h6M9 12h6" />
                            </svg>
                        @break

                        @default
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="2" y="5" width="20" height="15" rx="2" />
                                <path d="M2 10h20M16 15h2" />
                            </svg>
                    @endswitch

                </div>

                <!-- Stats -->
                <p class="text-xs font-medium text-slate-500 sm:text-sm">
                    {{ $stat['title'] }}
                </p>

                <h3
                    class="mt-2 break-all text-lg font-extrabold tracking-tight {{ $stat['value'] < 0 ? 'text-red-600' : 'text-slate-900' }} sm:text-2xl">
                    Rp{{ number_format($stat['value'], 0, ',', '.') }}
                </h3>

                <p class="mt-2 text-[11px] text-slate-400 sm:text-xs">
                    {{ $stat['description'] }}
                </p>

            </div>
        @endforeach

    </div>

    <!-- Add Expense -->
    <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14" />
                    </svg>

                </div>

                <div>
                    <h3 class="text-lg font-bold text-slate-900">
                        Catat Pengeluaran
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Tambahkan biaya operasional toko.
                    </p>
                </div>

            </div>

        </div>

        <form method="POST" action="{{ route('admin.expenses.store') }}" class="p-5 sm:p-6">

            @csrf

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Description -->
                <div class="sm:col-span-2">

                    <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                        Keterangan Pengeluaran
                    </label>

                    <input id="description" name="description" type="text" required maxlength="255"
                        value="{{ old('description') }}" placeholder="Contoh: Biaya hosting website"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-100">

                </div>

                <!-- Amount -->
                <div>

                    <label for="amount" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nominal (Rp)
                    </label>

                    <input id="amount" name="amount" type="number" min="1" step="1" required
                        value="{{ old('amount') }}" placeholder="Contoh: 150000"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-100">

                </div>

                <!-- Date -->
                <div>

                    <label for="spent_at" class="mb-2 block text-sm font-semibold text-slate-700">
                        Tanggal
                    </label>

                    <input id="spent_at" name="spent_at" type="date" required
                        value="{{ old('spent_at', date('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">

                </div>

            </div>

            <!-- Submit -->
            <div
                class="mt-6 flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-xs text-slate-400">
                    Pastikan nominal dan tanggal sudah benar sebelum menyimpan.
                </p>

                <button type="submit"
                    class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-red-600 bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-red-600">

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14" />
                    </svg>

                    Simpan Pengeluaran
                </button>

            </div>

        </form>

    </section>

    <!-- Expense History -->
    <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <!-- Header -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-5 sm:px-6">

            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Riwayat Pengeluaran
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Daftar biaya operasional yang telah dicatat.
                </p>
            </div>

            <span class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                {{ $expenses->total() }} Transaksi
            </span>

        </div>

        <!-- Expense List -->
        <div class="divide-y divide-slate-100">

            @forelse ($expenses as $e)
                <div
                    class="flex flex-col gap-4 p-4 transition hover:bg-slate-50 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                    <div class="flex min-w-0 items-center gap-3">

                        <!-- Icon -->
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path d="M6 2h12v20l-3-2-3 2-3-2-3 2z" />
                                <path d="M9 8h6M9 12h6" />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="break-words font-semibold text-slate-900">
                                {{ $e->description }}
                            </p>

                            <div class="mt-1 flex items-center gap-2 text-xs text-slate-500">

                                <span>
                                    {{ $e->spent_at->format('d M Y') }}
                                </span>

                                <span>•</span>

                                <span>Pengeluaran</span>

                            </div>

                        </div>

                    </div>

                    <!-- Amount & Actions -->
                    <div class="flex items-center justify-between gap-4 pl-14 sm:justify-end sm:pl-0">

                        <div class="text-left sm:text-right">
                            <p class="text-[11px] text-slate-400">
                                Nominal
                            </p>

                            <p class="font-bold text-slate-900">
                                Rp{{ number_format($e->amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('admin.expenses.delete', $e) }}"
                            onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" aria-label="Hapus pengeluaran"
                                class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600">

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

                </div>

            @empty

                <!-- Empty State -->
                <div class="px-5 py-16 text-center">

                    <div
                        class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path d="M6 2h12v20l-3-2-3 2-3-2-3 2z" />
                            <path d="M9 8h6M9 12h6" />
                        </svg>

                    </div>

                    <p class="font-semibold text-slate-700">
                        Belum ada pengeluaran
                    </p>

                    <p class="mt-2 text-sm text-slate-400">
                        Pengeluaran yang dicatat akan muncul di sini.
                    </p>

                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        @if ($expenses->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $expenses->links() }}
            </div>
        @endif

    </section>

    <!-- Info -->
    <div class="mt-6 flex items-start gap-3 rounded-xl border border-blue-100 bg-blue-50 p-4">

        <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 11v6M12 7h.01" />
        </svg>

        <p class="text-sm leading-relaxed text-blue-700">
            Laporan keuangan dihitung dari total pesanan yang telah dibayar,
            dikurangi modal produk terjual dan pengeluaran yang dicatat.
            Pastikan semua transaksi tercatat agar estimasi laba lebih akurat.
        </p>

    </div>

</x-layouts.admin>
