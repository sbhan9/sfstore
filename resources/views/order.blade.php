<x-layouts.app :title="'Pesanan ' . $order->code . ' - SFStore'">

    <div class="min-h-screen bg-slate-50 px-4 py-10 sm:py-16">

        <div class="mx-auto max-w-xl">

            <!-- Brand -->
            <div class="mb-8 flex justify-center">
                <a href="/" class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-600 font-extrabold text-white">
                        SF
                    </div>

                    <span class="text-xl font-extrabold tracking-tight text-slate-900">
                        SF<span class="text-red-600">Store</span>
                    </span>

                </a>
            </div>

            <!-- Confirmation Card -->
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <!-- Success Header -->
                <div class="px-5 pb-6 pt-9 text-center sm:px-8">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-50">

                        <svg class="h-11 w-11 text-green-600" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M7 12l3.5 3.5L17 9" />
                        </svg>

                    </div>

                    <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Pesanan Berhasil Dicatat!
                    </h1>

                    <p class="mx-auto mt-3 max-w-sm text-sm leading-relaxed text-slate-500">
                        Terima kasih sudah berbelanja di SFStore.
                        Pesanan sudah tercatat dan menunggu konfirmasi.
                    </p>

                </div>

                <!-- Order Information -->
                <div class="mx-5 rounded-2xl border border-slate-100 bg-slate-50 p-4 sm:mx-8 sm:p-5">

                    <div class="flex flex-wrap items-center justify-between gap-2">

                        <span class="text-sm text-slate-500">
                            Kode Pesanan
                        </span>

                        <span class="font-extrabold text-red-600">
                            {{ $order->code }}
                        </span>

                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-between gap-2">

                        <span class="text-sm text-slate-500">
                            Status Pembayaran
                        </span>

                        @php
                            $paymentLabels = [
                                'unpaid' => 'Belum Dibayar',
                                'paid' => 'Lunas',
                                'refunded' => 'Refund',
                            ];

                            $paymentColors = [
                                'unpaid' => 'bg-amber-100 text-amber-800',
                                'paid' => 'bg-green-100 text-green-800',
                                'refunded' => 'bg-red-100 text-red-800',
                            ];
                        @endphp

                        <span
                            class="rounded-full px-3 py-1.5 text-xs font-bold
                            {{ $paymentColors[$order->payment_status] ?? 'bg-slate-200 text-slate-600' }}">

                            {{ $paymentLabels[$order->payment_status] ?? $order->payment_status }}

                        </span>

                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-between gap-2">

                        <span class="text-sm text-slate-500">
                            Tanggal Pemesanan
                        </span>

                        <span class="text-sm font-semibold text-slate-700">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </span>

                    </div>

                </div>

                <!-- Product Summary -->
                <div class="px-5 py-7 sm:px-8">

                    <h2 class="mb-5 text-base font-bold text-slate-900">
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-4">

                        @foreach ($order->items as $item)
                            <div class="flex items-center gap-3">

                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-50">

                                    <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
                                        <path d="M21 8l-9 5-9-5" />
                                        <path d="M3 8l9-5 9 5v9l-9 5-9-5z" />
                                        <path d="M12 13v9" />
                                    </svg>

                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="break-words text-sm font-semibold text-slate-900">
                                        {{ $item->product_name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $item->quantity }} ×
                                        Rp{{ number_format($item->quantity ? $item->subtotal / $item->quantity : 0, 0, ',', '.') }}
                                    </p>

                                </div>

                                <span class="shrink-0 text-sm font-bold text-slate-900">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>

                            </div>
                        @endforeach

                    </div>

                    <!-- Total -->
                    <div class="mt-6 flex items-center justify-between border-t border-dashed border-slate-200 pt-5">

                        <span class="font-semibold text-slate-700">
                            Total Pembayaran
                        </span>

                        <span class="text-xl font-extrabold text-red-600 sm:text-2xl">
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

                <!-- Next Step -->
                <div class="border-t border-slate-100 bg-slate-50/80 px-5 py-6 sm:px-8">

                    <h3 class="text-sm font-bold text-slate-900">
                        Langkah Selanjutnya
                    </h3>

                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Hubungi admin melalui WhatsApp untuk
                        mendapatkan informasi pembayaran dan
                        melanjutkan proses pesanan.
                    </p>

                    @if ($waUrl)
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
                            class="mt-5 flex w-full items-center justify-center gap-3 rounded-xl border border-green-600 bg-green-600 px-5 py-4 text-sm font-bold text-white transition hover:bg-transparent hover:text-green-700">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21 11.5a8.4 8.4 0 0 1-.9 3.8A8.5 8.5 0 0 1 12.5 20a8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 12.5 3 8.5 8.5 0 0 1 21 11.5z" />
                            </svg>

                            Lanjutkan ke WhatsApp
                        </a>

                        <p class="mt-3 text-center text-xs leading-relaxed text-slate-400">
                            WhatsApp akan terbuka dengan pesan siap dikirim.
                            Pastikan menekan tombol Kirim agar admin
                            menerima pesan.
                        </p>
                    @else
                        <div class="mt-5 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                            Nomor WhatsApp admin belum tersedia.
                            Silakan hubungi toko melalui kontak resmi lainnya.
                        </div>
                    @endif

                    <!-- Back -->
                    <a href="/"
                        class="mt-5 flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:text-red-600">

                        <span>←</span>
                        Kembali ke Toko

                    </a>

                </div>

            </div>

            <!-- Footer -->
            <p class="mt-7 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} SFStore. Digital Product Store.
            </p>

        </div>

    </div>

</x-layouts.app>
