<x-layouts.admin>

    <!-- Header -->
    <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-widest text-red-600">
                Order Management
            </p>

            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                Pesanan Masuk
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Pantau pesanan pelanggan dan kelola status pembayaran SFStore.
            </p>
        </div>

        <div
            class="inline-flex items-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-medium text-slate-600">
            <span class="h-2 w-2 rounded-full bg-green-500"></span>
            {{ $orders->total() }} Total Pesanan
        </div>
    </div>

    <!-- Information -->
    <div class="mb-6 flex items-start gap-3 rounded-xl border border-blue-100 bg-blue-50 p-4">

        <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 11v6M12 7h.01" />
        </svg>

        <p class="text-sm leading-relaxed text-blue-700">
            Pesanan otomatis tercatat sebelum pelanggan membuka WhatsApp.
            Pastikan pembayaran benar-benar diterima sebelum mengubah
            status menjadi <strong>Lunas</strong>.
        </p>
    </div>

    <!-- Orders List -->
    <div class="space-y-5">

        @forelse ($orders as $o)

            @php
                $paymentLabels = [
                    'unpaid' => 'Belum Bayar',
                    'paid' => 'Lunas',
                    'refunded' => 'Refund',
                ];

                $orderLabels = [
                    'new' => 'Baru',
                    'processing' => 'Diproses',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ];

                $paymentColors = [
                    'unpaid' => 'bg-amber-50 text-amber-700 ring-amber-200',
                    'paid' => 'bg-green-50 text-green-700 ring-green-200',
                    'refunded' => 'bg-red-50 text-red-700 ring-red-200',
                ];

                $statusColors = [
                    'new' => 'bg-blue-50 text-blue-700 ring-blue-200',
                    'processing' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
                    'completed' => 'bg-green-50 text-green-700 ring-green-200',
                    'cancelled' => 'bg-slate-100 text-slate-600 ring-slate-200',
                ];

                $phone = preg_replace('/\D/', '', $o->customer_phone ?? '');

                if (str_starts_with($phone, '0')) {
                    $phone = '62' . substr($phone, 1);
                }

                $message = "Halo {$o->customer_name}, terkait pesanan {$o->code} di SFStore.";
                $waUrl = $phone ? 'https://wa.me/' . $phone . '?text=' . rawurlencode($message) : null;
            @endphp

            <article
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">

                <!-- Order Header -->
                <div
                    class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-start sm:justify-between sm:p-6">

                    <div class="flex min-w-0 items-start gap-3">

                        <!-- Avatar -->
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 font-bold text-red-600">
                            {{ strtoupper(substr($o->customer_name ?? 'P', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-bold text-red-600">
                                {{ $o->code }}
                            </p>

                            <h3 class="mt-1 break-words text-base font-bold text-slate-900">
                                {{ $o->customer_name }}
                            </h3>

                            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500">
                                <span>{{ $o->created_at->format('d M Y, H:i') }}</span>
                                <span>{{ $o->customer_phone }}</span>
                            </div>

                        </div>
                    </div>

                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2">

                        <span
                            class="inline-flex rounded-full px-3 py-1.5 text-xs font-semibold ring-1 ring-inset
                            {{ $paymentColors[$o->payment_status] ?? 'bg-slate-100 text-slate-600 ring-slate-200' }}">

                            {{ $paymentLabels[$o->payment_status] ?? $o->payment_status }}

                        </span>

                        <span
                            class="inline-flex rounded-full px-3 py-1.5 text-xs font-semibold ring-1 ring-inset
                            {{ $statusColors[$o->status] ?? 'bg-slate-100 text-slate-600 ring-slate-200' }}">

                            {{ $orderLabels[$o->status] ?? $o->status }}

                        </span>

                    </div>

                </div>

                <!-- Order Products -->
                <div class="px-5 py-5 sm:px-6">

                    <p class="mb-4 text-xs font-bold uppercase tracking-wider text-slate-400">
                        Detail Produk
                    </p>

                    <div class="space-y-3">

                        @foreach ($o->items as $item)
                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path d="M21 8l-9 5-9-5" />
                                        <path d="M3 8l9-5 9 5v9l-9 5-9-5z" />
                                        <path d="M12 13v9" />
                                    </svg>

                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="break-words text-sm font-semibold text-slate-800">
                                        {{ $item->product_name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $item->quantity }} ×
                                        Rp{{ number_format($item->quantity ? $item->subtotal / $item->quantity : 0, 0, ',', '.') }}
                                    </p>

                                </div>

                                <p class="shrink-0 text-sm font-bold text-slate-900">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>

                            </div>
                        @endforeach

                    </div>

                    @if ($o->notes)
                        <div class="mt-5 rounded-xl bg-slate-50 p-4">
                            <p class="text-xs font-semibold text-slate-600">
                                Catatan Pelanggan
                            </p>
                            <p class="mt-1 break-words text-sm text-slate-700">
                                {{ $o->notes }}
                            </p>
                        </div>
                    @endif

                    <!-- Total -->
                    <div class="mt-5 flex items-center justify-between border-t border-dashed border-slate-200 pt-5">

                        <span class="text-sm font-medium text-slate-500">
                            Total Pesanan
                        </span>

                        <span class="text-xl font-extrabold text-red-600">
                            Rp{{ number_format($o->total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

                <!-- Actions -->
                <div class="border-t border-slate-100 bg-slate-50/70 p-5 sm:p-6">

                    <form method="POST" action="{{ route('admin.orders.update', $o) }}">

                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <!-- Payment Status -->
                            <div>
                                <label for="payment-{{ $o->id }}"
                                    class="mb-2 block text-xs font-semibold text-slate-600">
                                    Status Pembayaran
                                </label>

                                <select id="payment-{{ $o->id }}" name="payment_status"
                                    class="w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">

                                    @foreach ($paymentLabels as $value => $label)
                                        <option value="{{ $value }}" @selected($o->payment_status === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- Order Status -->
                            <div>
                                <label for="status-{{ $o->id }}"
                                    class="mb-2 block text-xs font-semibold text-slate-600">
                                    Status Pesanan
                                </label>

                                <select id="status-{{ $o->id }}" name="status"
                                    class="w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">

                                    @foreach ($orderLabels as $value => $label)
                                        <option value="{{ $value }}" @selected($o->status === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-end">

                            @if ($waUrl)
                                <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-sm font-semibold text-green-700 transition hover:bg-green-100">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M21 11.5a8.4 8.4 0 0 1-.9 3.8A8.5 8.5 0 0 1 12.5 20a8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 12.5 3 8.5 8.5 0 0 1 21 11.5z" />
                                    </svg>

                                    Hubungi WhatsApp
                                </a>
                            @endif

                            <button type="submit"
                                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-red-600 bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-red-600">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M5 12l4 4L19 6" />
                                </svg>

                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </article>

        @empty

            <!-- Empty State -->
            <div class="rounded-2xl border border-slate-200 bg-white px-5 py-16 text-center">

                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">

                    <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path d="M4 7h16l-1 14H5L4 7z" />
                        <path d="M9 9V6a3 3 0 016 0v3" />
                    </svg>

                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    Belum Ada Pesanan
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Pesanan pelanggan akan otomatis muncul di halaman ini.
                </p>

            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    @if ($orders->hasPages())
        <div class="mt-6 rounded-xl border border-slate-200 bg-white px-4 py-4">
            {{ $orders->links() }}
        </div>
    @endif

</x-layouts.admin>
