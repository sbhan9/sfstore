<x-layouts.admin>

    @php
        $profit = $revenue - $cost - $expense;

        $stats = [
            [
                'title' => 'Total Produk',
                'value' => number_format($productCount, 0, ',', '.'),
                'description' => 'Produk dalam katalog',
                'icon' => 'package',
            ],
            [
                'title' => 'Semua Pesanan',
                'value' => number_format($orderCount, 0, ',', '.'),
                'description' => 'Total pesanan masuk',
                'icon' => 'orders',
            ],
            [
                'title' => 'Penjualan Lunas',
                'value' => 'Rp' . number_format($revenue, 0, ',', '.'),
                'description' => 'Total pembayaran lunas',
                'icon' => 'wallet',
            ],
            [
                'title' => 'Estimasi Laba',
                'value' => 'Rp' . number_format($profit, 0, ',', '.'),
                'description' => 'Pendapatan dikurangi biaya',
                'icon' => 'profit',
            ],
        ];
    @endphp

    <!-- Dashboard Header -->
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="mb-2 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                    Store Overview
                </span>
            </div>

            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                Ringkasan Toko
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Pantau aktivitas penjualan dan performa bisnis SFStore.
            </p>
        </div>

        <a href="{{ route('admin.products') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-600 bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-red-600">

            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14" />
            </svg>

            Kelola Produk
        </a>

    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-5">

        @foreach ($stats as $stat)
            <div
                class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-red-200 hover:shadow-lg sm:p-5">

                <div class="mb-5 flex items-center justify-between">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600 transition group-hover:bg-red-600 group-hover:text-white">

                        @switch($stat['icon'])
                            @case('package')
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

                            @case('wallet')
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <rect x="2" y="5" width="20" height="15" rx="2" />
                                    <path d="M2 10h20M16 15h2" />
                                </svg>
                            @break

                            @default
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path d="M3 17l6-6 4 4 8-8" />
                                    <path d="M15 7h6v6" />
                                </svg>
                        @endswitch

                    </div>

                    <span class="text-slate-300 transition group-hover:text-red-600">
                        ↗
                    </span>
                </div>

                <p class="text-xs font-medium text-slate-500 sm:text-sm">
                    {{ $stat['title'] }}
                </p>

                <h3 class="mt-2 break-words text-xl font-extrabold tracking-tight text-slate-900 sm:text-2xl">
                    {{ $stat['value'] }}
                </h3>

                <p class="mt-2 text-[11px] text-slate-400 sm:text-xs">
                    {{ $stat['description'] }}
                </p>

            </div>
        @endforeach

    </div>

    <!-- Recent Orders -->
    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <!-- Table Header -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-5 sm:px-6">

            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Pesanan Terbaru
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Pantau pesanan terbaru yang masuk ke SFStore.
                </p>
            </div>

            <a href="{{ route('admin.orders') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 transition hover:text-red-700">
                Lihat Semua
                <span>→</span>
            </a>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[650px] text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">
                            Kode Pesanan
                        </th>
                        <th class="px-6 py-4 font-semibold">
                            Pelanggan
                        </th>
                        <th class="px-6 py-4 font-semibold">
                            Total
                        </th>
                        <th class="px-6 py-4 font-semibold">
                            Pembayaran
                        </th>
                        <th class="px-6 py-4 font-semibold">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($recent as $o)
                        @php
                            $paid = in_array(strtolower((string) $o->payment_status), ['paid', 'lunas']);

                            $paymentLabel = $paid ? 'Lunas' : 'Belum Lunas';

                            $orderStatus = strtolower((string) $o->status);
                        @endphp

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900">
                                    {{ $o->code }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-50 font-semibold text-red-600">
                                        {{ strtoupper(substr($o->customer_name ?? 'P', 0, 1)) }}
                                    </div>

                                    <span class="font-medium text-slate-700">
                                        {{ $o->customer_name }}
                                    </span>

                                </div>
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                Rp{{ number_format($o->total, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $paid ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700' }}">

                                    {{ $paymentLabel }}

                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ in_array($orderStatus, ['completed', 'selesai'])
                                        ? 'bg-green-50 text-green-700'
                                        : 'bg-slate-100 text-slate-600' }}">

                                    {{ ucfirst(str_replace('_', ' ', $o->status)) }}

                                </span>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">

                                <div
                                    class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                                    <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M4 7h16l-1 14H5L4 7z" />
                                        <path d="M9 9V6a3 3 0 016 0v3" />
                                    </svg>

                                </div>

                                <p class="font-semibold text-slate-700">
                                    Belum ada pesanan
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Pesanan pelanggan akan muncul di sini.
                                </p>

                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Footer Info -->
    <div
        class="mt-5 flex items-start gap-2 rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-700">

        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 11v6M12 7h.01" />
        </svg>

        <p>
            Ringkasan penjualan dihitung dari pesanan dengan pembayaran
            berstatus lunas. Pesanan yang belum dibayar tidak dihitung sebagai pendapatan.
        </p>

    </div>

</x-layouts.admin>
