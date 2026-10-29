<x-layouts.app :title="($shop ?? 'SFStore') . ' - Produk Digital'">
    @php
        $categories = $products->pluck('category')->filter()->unique()->values();
        $visibleFeatured = $featured->take(3);
    @endphp

    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur-xl">

        <!-- Promo Bar -->
        <div class="bg-red-700 px-4 py-2.5 text-center text-white">

            <div class="mx-auto flex max-w-7xl items-center justify-center gap-2">

                <svg class="h-4 w-4 shrink-0 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="m13 2-9 12h7l-1 8 10-12h-7z" />
                </svg>

                <p class="text-[11px] font-medium sm:text-xs">
                    <span class="font-bold">
                        Upgrade Skill, Hemat Budget!
                    </span>
                    <span class="hidden sm:inline">
                        Temukan penawaran spesial produk digital pilihan.
                    </span>
                </p>

                <a href="#produk"
                    class="shrink-0 text-[11px] font-bold underline underline-offset-2 transition hover:text-yellow-200 sm:text-xs">
                    Lihat Promo
                </a>

            </div>

        </div>
        <!-- End Promo Bar -->


        <div class="mx-auto flex max-w-7xl items-center gap-3 px-4 py-3 sm:px-6 lg:gap-8">
            <a href="/" class="flex shrink-0 items-center gap-2.5" aria-label="Beranda SFStore">
                <span
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-600 text-sm font-extrabold tracking-tight text-white shadow-sm shadow-red-200">SF</span>
                <span class="text-lg font-extrabold tracking-tight text-slate-950 sm:text-xl">SF<span
                        class="text-red-600">Store</span></span>
            </a>
            <div class="hidden max-w-xl flex-1 sm:block">
                <label class="relative block">
                    <span class="sr-only">Cari produk digital</span>
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m16 16 4 4" />
                    </svg>
                    <input id="searchTop" type="search" autocomplete="off"
                        placeholder="Cari source code, e-book, template..."
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm outline-none transition focus:border-red-400 focus:bg-white focus:ring-4 focus:ring-red-50">
                </label>
            </div>
            <nav class="ml-auto hidden items-center gap-6 text-sm font-semibold text-slate-600 lg:flex"
                aria-label="Navigasi utama">
                <a href="#kategori" class="hover:text-red-600">Kategori</a>
                <a href="#produk" class="hover:text-red-600">Produk</a>
                <a href="#faq" class="hover:text-red-600">Bantuan</a>
            </nav>
            <div class="ml-auto flex items-center gap-2 lg:ml-2">
                <button id="openCart" type="button" aria-label="Buka keranjang"
                    class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="19" cy="21" r="1" />
                        <path d="M2 3h2l2.4 12.4a2 2 0 0 0 2 1.6h9.5a2 2 0 0 0 2-1.6L22 7H5" />
                    </svg>
                    <span id="cartBadge"
                        class="absolute -right-1.5 -top-1.5 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1 text-[10px] font-bold text-white">0</span>
                </button>
                <a href="{{ route('login') }}"
                    class="rounded-xl bg-red-600 px-4 py-3 text-xs font-bold text-white transition hover:bg-red-700 sm:text-sm">Admin</a>
            </div>
        </div>
        <div class="px-4 pb-3 sm:hidden">
            <label class="relative block">
                <span class="sr-only">Cari produk</span>
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m16 16 4 4" />
                </svg>
                <input id="searchMobile" type="search" autocomplete="off" placeholder="Cari produk digital..."
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm outline-none focus:border-red-400 focus:bg-white focus:ring-4 focus:ring-red-50">
            </label>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 md:pb-14">
        <section
            class="relative mt-5 overflow-hidden rounded-3xl bg-gradient-to-br from-[#7f1d1d] via-red-700 to-red-500 px-6 py-10 text-white sm:mt-7 sm:px-12 sm:py-16">
            <div
                class="pointer-events-none absolute -right-16 -top-28 h-72 w-72 rounded-full border-[45px] border-white/10 sm:right-10">
            </div>
            <div
                class="pointer-events-none absolute bottom-0 right-12 h-32 w-32 rotate-12 rounded-3xl bg-white/10 blur-xl">
            </div>
            <div class="relative max-w-2xl">
                <span
                    class="inline-flex rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-red-50">✦
                    Digital Product Marketplace</span>
                <h1 class="mt-5 text-3xl font-black leading-tight tracking-tight sm:text-5xl">Solusi digital pilihan,
                    <span class="text-red-100">semua di satu tempat.</span>
                </h1>
                <p class="mt-4 max-w-lg text-sm leading-6 text-red-50/90 sm:text-base">Temukan source code, template,
                    e-book, dan kebutuhan kreatif. Tambah ke keranjang, kemudian pesan praktis lewat WhatsApp.</p>
                <div class="mt-7 flex flex-wrap items-center gap-3">
                    <a href="#produk"
                        class="inline-flex items-center justify-center rounded-xl border-2 border-white bg-white px-5 py-3 text-sm font-bold text-red-700 transition hover:bg-transparent hover:text-white">Jelajahi
                        Produk ↗</a>
                    <a href="#cara-beli"
                        class="inline-flex items-center justify-center rounded-xl border-2 border-white/40 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Cara
                        Belanja</a>
                </div>
            </div>
        </section>

        <section id="kategori" class="mt-10 scroll-mt-36 sm:mt-12">
            <div class="flex items-end justify-between gap-3">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-widest text-red-600">Jelajahi koleksi</p>
                    <h2 class="mt-1 text-xl font-black tracking-tight text-slate-950 sm:text-2xl">Kategori Produk</h2>
                </div>
                <span class="text-xs text-slate-500">Pilih sesuai kebutuhan</span>
            </div>
            <div id="categories"
                class="mt-4 flex gap-2 overflow-x-auto pb-3 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <button type="button" data-category="Semua" aria-pressed="true"
                    class="category shrink-0 whitespace-nowrap rounded-full border border-red-600 bg-red-600 px-5 py-2.5 text-xs font-bold text-white transition sm:text-sm">Semua
                    Produk</button>
                @foreach ($categories as $cat)
                    <button type="button" data-category="{{ $cat }}" aria-pressed="false"
                        class="category shrink-0 whitespace-nowrap rounded-full border border-slate-200 bg-white px-5 py-2.5 text-xs font-semibold text-slate-600 transition hover:border-red-300 hover:text-red-600 sm:text-sm">{{ $cat }}</button>
                @endforeach
            </div>
        </section>

        @if ($visibleFeatured->isNotEmpty())
            <section class="mt-7 rounded-2xl border border-red-100 bg-red-50 p-5 sm:p-6"
                aria-label="Produk rekomendasi">
                <div class="flex items-center gap-2"><span class="text-xl">✨</span>
                    <h2 class="font-extrabold text-red-900">Pilihan spesial SFStore</h2>
                </div>
                <p class="mt-2 text-sm leading-6 text-red-900/80">{{ $visibleFeatured->pluck('name')->join(' · ') }}
                </p>
                <a href="#produk" class="mt-3 inline-flex text-sm font-bold text-red-700 hover:underline">Lihat
                    katalog →</a>
            </section>
        @endif

        <section id="produk" class="mt-9 scroll-mt-40 sm:scroll-mt-28">
            <div class="flex items-end justify-between gap-3">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-widest text-red-600">Katalog Digital</p>
                    <h2 class="mt-1 text-xl font-black tracking-tight text-slate-950 sm:text-2xl">Produk Pilihan</h2>
                    <p class="mt-1 text-xs text-slate-500 sm:text-sm">Produk digital untuk belajar, berkarya, dan
                        produktif.</p>
                </div>
                <span id="resultCount" role="status"
                    class="shrink-0 rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 ring-1 ring-slate-200">{{ $products->count() }}
                    produk</span>
            </div>
            <div id="productGrid" class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-4">
                @forelse ($products as $product)
                    <article data-name="{{ $product->name }}" data-category="{{ $product->category }}"
                        data-description="{{ $product->description }}"
                        class="product-card group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg"
                        data-id="{{ $product->id }}" data-name="{{ mb_strtolower($product->name) }}"
                        data-category="{{ $product->category }}" data-price="{{ $product->price }}">
                        <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-red-50 to-slate-100">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center text-5xl">📦</div>
                            @endif
                            @if ($product->featured)
                                <span
                                    class="absolute left-2 top-2 rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-extrabold text-red-600 shadow-sm">★
                                    Pilihan</span>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-3 sm:p-4">
                            <p class="text-[10px] font-extrabold uppercase tracking-wide text-red-600 sm:text-xs">
                                {{ $product->category }}</p>
                            <h3
                                class="mt-1 line-clamp-2 min-h-10 text-xs font-bold leading-5 text-slate-900 sm:text-sm">
                                {{ $product->name }}</h3>
                            <p class="mt-1 line-clamp-2 text-[11px] leading-4 text-slate-500 sm:text-xs">
                                {{ $product->description }}</p>
                            <div class="mt-auto pt-4">
                                @if ($product->compare_price && $product->compare_price > $product->price)
                                    <p class="text-[10px] text-slate-400 line-through sm:text-xs">
                                        Rp{{ number_format($product->compare_price, 0, ',', '.') }}</p>
                                @endif
                                <p class="break-words text-base font-black tracking-tight text-red-600 sm:text-lg">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <button type="button" data-add="{{ $product->id }}"
                                    class="mt-3 flex w-full items-center justify-center gap-1 rounded-xl border border-red-600 bg-red-600 px-2 py-2.5 text-[11px] font-bold text-white transition hover:bg-white hover:text-red-600 sm:text-sm">+
                                    Keranjang</button>
                            </div>
                        </div>
                    </article>
                @empty
                    <div
                        class="col-span-full rounded-2xl border border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
                        Belum ada produk aktif.</div>
                @endforelse
            </div>
            <div id="emptySearch"
                class="mt-5 hidden rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center">
                <p class="font-bold text-slate-800">Produk tidak ditemukan</p>
                <p class="mt-1 text-sm text-slate-500">Coba kata kunci atau kategori lain.</p>
            </div>
        </section>

        <section id="cara-beli" class="mt-14 scroll-mt-36">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-red-600">Belanja praktis</p>
                <h2 class="mt-2 text-xl font-black sm:text-2xl">Cara Order di SFStore</h2>
            </div>
            <div class="mt-6 grid gap-3 sm:grid-cols-3 sm:gap-5">
                <div class="rounded-2xl border border-slate-200 bg-white p-5"><span
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-lg font-extrabold text-red-600">01</span>
                    <h3 class="mt-4 font-bold">Pilih produk</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Cari produk digital dan tambahkan ke keranjang.
                    </p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5"><span
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-lg font-extrabold text-red-600">02</span>
                    <h3 class="mt-4 font-bold">Isi data checkout</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Masukkan nama dan nomor WhatsApp yang aktif.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5"><span
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-lg font-extrabold text-red-600">03</span>
                    <h3 class="mt-4 font-bold">Konfirmasi lewat WA</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Order tercatat, lalu lanjut kirim pesan ke admin
                        untuk pembayaran.</p>
                </div>
            </div>
        </section>

        <section id="faq" class="mt-14 scroll-mt-36">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-widest text-red-600">Pusat Bantuan</p>
                <h2 class="mt-1 text-xl font-black sm:text-2xl">Pertanyaan Umum</h2>
            </div>
            <div class="mt-5 space-y-3">
                <details class="group rounded-2xl border border-slate-200 bg-white p-5">
                    <summary class="cursor-pointer font-semibold text-slate-900">Bagaimana cara memesan produk?
                    </summary>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Tambahkan produk ke keranjang, isi data pembeli,
                        lalu lanjutkan percakapan melalui WhatsApp admin.</p>
                </details>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5">
                    <summary class="cursor-pointer font-semibold text-slate-900">Apakah pembayaran otomatis?</summary>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Belum. Admin memberikan instruksi pembayaran dan
                        memverifikasi transfer secara manual sebelum pesanan diproses.</p>
                </details>
                <details class="group rounded-2xl border border-slate-200 bg-white p-5">
                    <summary class="cursor-pointer font-semibold text-slate-900">Kapan produk digital dikirim?
                    </summary>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Admin akan menginformasikan pengiriman setelah
                        pembayaran diverifikasi. Waktu pengiriman mengikuti konfirmasi admin.</p>
                </details>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 px-5 py-10 pb-28 text-slate-300 md:pb-10">
        <div class="mx-auto grid max-w-7xl gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <div class="flex items-center gap-2"><span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-600 font-black text-white">SF</span><span
                        class="text-xl font-black text-white">SF<span class="text-red-500">Store</span></span></div>
                <p class="mt-3 max-w-sm text-sm leading-6 text-slate-400">Toko produk digital dengan katalog praktis
                    dan pemesanan langsung ke WhatsApp admin.</p>
            </div>
            <div>
                <h3 class="font-bold text-white">Jelajahi</h3>
                <div class="mt-3 flex flex-col gap-2 text-sm"><a href="#kategori" class="hover:text-white">Kategori
                        Produk</a><a href="#produk" class="hover:text-white">Produk Digital</a><a href="#faq"
                        class="hover:text-white">Pertanyaan Umum</a></div>
            </div>
            <div>
                <h3 class="font-bold text-white">Informasi</h3>
                <p class="mt-3 text-sm leading-6 text-slate-400">Order tersimpan saat checkout. Pembayaran dikonfirmasi
                    manual melalui admin.</p><a href="{{ route('login') }}"
                    class="mt-3 inline-flex text-sm font-semibold text-red-400 hover:text-red-300">Masuk Admin ↗</a>
            </div>
        </div>
        <div class="mx-auto mt-8 max-w-7xl border-t border-white/10 pt-5 text-xs text-slate-500">© {{ date('Y') }}
            SFStore. All rights reserved.</div>
    </footer>

    <nav class="fixed inset-x-0 bottom-0 z-30 grid grid-cols-3 border-t border-slate-200 bg-white/95 px-2 py-2 pb-[max(.5rem,env(safe-area-inset-bottom))] text-center text-[11px] font-semibold shadow-[0_-8px_30px_rgba(15,23,42,.06)] backdrop-blur md:hidden"
        aria-label="Navigasi mobile">
        <a href="/" class="flex flex-col items-center gap-1 rounded-lg py-1 text-red-600"><span
                class="text-xl leading-none">⌂</span>Beranda</a>
        <a href="#produk" class="flex flex-col items-center gap-1 rounded-lg py-1 text-slate-600"><span
                class="text-xl leading-none">▦</span>Produk</a>
        <button id="openCartBottom" type="button"
            class="flex flex-col items-center gap-1 rounded-lg py-1 text-slate-600"><span
                class="text-xl leading-none">🛒</span>Keranjang</button>
    </nav>

    <div id="cartOverlay" class="fixed inset-0 z-50 hidden bg-slate-950/60" role="dialog" aria-modal="true"
        aria-labelledby="cartTitle">
        <div class="absolute inset-y-0 right-0 flex w-full max-w-md flex-col bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-red-600">SFStore</p>
                    <h2 id="cartTitle" class="text-xl font-black">Keranjang Belanja</h2>
                </div><button id="closeCart"
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-2xl text-slate-600"
                    type="button" aria-label="Tutup keranjang">×</button>
            </div>
            <div id="cartList" class="min-h-0 flex-1 space-y-3 overflow-y-auto p-5"></div>
            <div class="border-t border-slate-200 bg-white p-5 pb-[max(1.25rem,env(safe-area-inset-bottom))]">
                <div class="mb-4 flex items-center justify-between"><span class="text-sm text-slate-500">Total
                        pesanan</span><span id="cartTotal" class="text-xl font-black text-red-600">Rp0</span></div>
                <form method="POST" action="{{ route('checkout') }}" id="checkoutForm" class="space-y-3">
                    @csrf
                    <input type="hidden" name="cart" id="cartInput">
                    <label class="block"><span class="mb-1 block text-xs font-bold text-slate-700">Nama
                            pembeli</span><input name="customer_name" value="{{ old('customer_name') }}" required
                            maxlength="100" autocomplete="name" placeholder="Nama lengkap"
                            class="w-full rounded-xl border border-slate-200 p-3 text-sm outline-none focus:border-red-500"></label>
                    <label class="block"><span class="mb-1 block text-xs font-bold text-slate-700">Nomor
                            WhatsApp</span><input name="customer_phone" value="{{ old('customer_phone') }}" required
                            type="tel" inputmode="tel" pattern="[0-9+ ]{8,20}" placeholder="08xxxxxxxxxx"
                            class="w-full rounded-xl border border-slate-200 p-3 text-sm outline-none focus:border-red-500"></label>
                    <label class="block"><span class="mb-1 block text-xs font-bold text-slate-700">Catatan
                            (opsional)</span>
                        <textarea name="notes" maxlength="500" placeholder="Catatan pesanan"
                            class="w-full rounded-xl border border-slate-200 p-3 text-sm outline-none focus:border-red-500" rows="2">{{ old('notes') }}</textarea>
                    </label>
                    <button id="checkoutButton" type="submit"
                        class="w-full rounded-xl bg-green-600 py-3.5 text-sm font-bold text-white transition hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50">Simpan
                        Order & Lanjut WhatsApp ↗</button>
                    <p class="text-center text-[11px] leading-5 text-slate-500">Pesanan dicatat terlebih dahulu.
                        Pembayaran tetap dikonfirmasi manual oleh admin.</p>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div role="alert"
            class="fixed bottom-24 left-4 right-4 z-[60] mx-auto max-w-md rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 shadow-lg">
            {{ $errors->first() }} <button type="button" onclick="this.parentElement.remove()"
                aria-label="Tutup pesan" class="float-right font-bold">×</button></div>
    @endif


    <script>
        (() => {
            // ==========================================
            // 1. DATA PRODUK & KERANJANG
            // ==========================================

            const catalog = @js(
    $products
        ->map(
            fn($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price,
            ],
        )
        ->values(),
);

            const index = Object.fromEntries(
                catalog.map(product => [product.id, product])
            );

            const storageKey = 'sfstore_cart';

            let cart = {};

            try {
                cart = JSON.parse(
                    localStorage.getItem(storageKey) ||
                    localStorage.getItem('sstore_cart') ||
                    '{}'
                );

                if (!cart || typeof cart !== 'object' || Array.isArray(cart)) {
                    cart = {};
                }
            } catch {
                cart = {};
            }

            // Validasi isi keranjang
            for (const id of Object.keys(cart)) {
                if (
                    !index[id] ||
                    !Number.isInteger(cart[id]) ||
                    cart[id] < 1 ||
                    cart[id] > 20
                ) {
                    delete cart[id];
                }
            }

            const money = value =>
                'Rp' + Number(value).toLocaleString('id-ID');

            const overlay = document.getElementById('cartOverlay');
            const cartList = document.getElementById('cartList');
            const cartBadge = document.getElementById('cartBadge');
            const cartTotal = document.getElementById('cartTotal');
            const checkoutButton = document.getElementById('checkoutButton');

            let previousFocus;

            // ==========================================
            // 2. BUKA & TUTUP KERANJANG
            // ==========================================

            function openCart() {
                previousFocus = document.activeElement;

                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                render();

                document.getElementById('closeCart')?.focus();
            }

            function closeCart() {
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');

                previousFocus?.focus?.();
            }

            document.getElementById('openCart')
                ?.addEventListener('click', openCart);

            document.getElementById('openCartBottom')
                ?.addEventListener('click', openCart);

            document.getElementById('closeCart')
                ?.addEventListener('click', closeCart);

            overlay?.addEventListener('click', event => {
                if (event.target === overlay) {
                    closeCart();
                }
            });

            document.addEventListener('keydown', event => {
                if (
                    event.key === 'Escape' &&
                    !overlay.classList.contains('hidden')
                ) {
                    closeCart();
                }
            });

            // ==========================================
            // 3. RENDER KERANJANG
            // ==========================================

            function render() {
                try {
                    localStorage.setItem(storageKey, JSON.stringify(cart));
                } catch (error) {
                    console.warn('Keranjang tidak dapat disimpan:', error);
                }

                const quantity = Object.values(cart)
                    .reduce((total, qty) => total + qty, 0);

                if (cartBadge) {
                    cartBadge.textContent = quantity;
                }

                document.querySelectorAll('[data-cart-count]')
                    .forEach(element => {
                        element.textContent = quantity;
                    });

                if (!cartList) return;

                cartList.replaceChildren();

                let total = 0;

                for (const [id, qty] of Object.entries(cart)) {
                    const product = index[id];

                    if (!product) continue;

                    total += Number(product.price) * qty;

                    const item = document.createElement('div');

                    item.className =
                        'flex items-center gap-2 rounded-xl border border-slate-200 p-3';

                    const info = document.createElement('div');
                    info.className = 'min-w-0 flex-1';

                    const name = document.createElement('p');
                    name.textContent = product.name;
                    name.className =
                        'break-words text-sm font-bold text-slate-900';

                    const price = document.createElement('p');
                    price.textContent = money(product.price * qty);
                    price.className =
                        'mt-1 text-sm font-bold text-red-600';

                    info.append(name, price);

                    const minus = document.createElement('button');
                    minus.type = 'button';
                    minus.textContent = '−';
                    minus.setAttribute(
                        'aria-label',
                        'Kurangi ' + product.name
                    );
                    minus.className =
                        'h-9 w-9 shrink-0 rounded-lg bg-slate-100 font-bold transition hover:bg-red-50';

                    minus.addEventListener('click', () => {
                        change(id, -1);
                    });

                    const count = document.createElement('span');
                    count.textContent = qty;
                    count.className =
                        'min-w-4 text-center text-sm font-bold';

                    const plus = document.createElement('button');
                    plus.type = 'button';
                    plus.textContent = '+';
                    plus.setAttribute(
                        'aria-label',
                        'Tambah ' + product.name
                    );
                    plus.className =
                        'h-9 w-9 shrink-0 rounded-lg bg-slate-100 font-bold transition hover:bg-red-50';

                    plus.addEventListener('click', () => {
                        change(id, 1);
                    });

                    item.append(info, minus, count, plus);
                    cartList.append(item);
                }

                if (total === 0) {
                    const empty = document.createElement('div');

                    empty.className =
                        'py-16 text-center text-sm text-slate-500';

                    empty.textContent = '🛒 Keranjang lu masih kosong.';

                    cartList.append(empty);
                }

                if (cartTotal) {
                    cartTotal.textContent = money(total);
                }

                if (checkoutButton) {
                    checkoutButton.disabled = total === 0;

                    checkoutButton.classList.toggle(
                        'opacity-50',
                        total === 0
                    );

                    checkoutButton.classList.toggle(
                        'cursor-not-allowed',
                        total === 0
                    );
                }
            }

            // ==========================================
            // 4. TAMBAH & KURANGI PRODUK
            // ==========================================

            function change(id, delta) {
                if (!index[id]) return;

                cart[id] = Math.max(
                    0,
                    Math.min(20, (cart[id] || 0) + delta)
                );

                if (cart[id] === 0) {
                    delete cart[id];
                }

                render();
            }

            document.querySelectorAll('[data-add]').forEach(button => {
                button.addEventListener('click', () => {
                    change(button.dataset.add, 1);
                    openCart();
                });
            });

            // ==========================================
            // 5. CHECKOUT WHATSAPP
            // ==========================================

            document.getElementById('checkoutForm')
                ?.addEventListener('submit', event => {

                    if (Object.keys(cart).length === 0) {
                        event.preventDefault();
                        return;
                    }

                    const items = Object.entries(cart).map(
                        ([id, qty]) => ({
                            id: Number(id),
                            qty: qty
                        })
                    );

                    const cartInput = document.getElementById('cartInput');

                    if (cartInput) {
                        cartInput.value = JSON.stringify(items);
                    }
                });

            // ==========================================
            // 6. SEARCH & FILTER PRODUK
            // ==========================================

            let term = '';
            let category = 'Semua';

            const searchTop = document.getElementById('searchTop');
            const searchMobile = document.getElementById('searchMobile');

            const productCards = document.querySelectorAll('.product-card');
            const categoryButtons = document.querySelectorAll('.category');

            const resultCount = document.getElementById('resultCount');
            const emptySearch = document.getElementById('emptySearch');

            // Normalisasi teks agar pencarian tidak sensitif huruf besar/kecil
            function normalize(value) {
                return String(value ?? '')
                    .toLocaleLowerCase('id-ID')
                    .trim();
            }

            // Filter katalog
            function filter() {
                let count = 0;

                productCards.forEach(card => {
                    const name = normalize(card.dataset.name);
                    const productCategory = normalize(card.dataset.category);
                    const description = normalize(
                        card.dataset.description ||
                        card.querySelector('p.line-clamp-2')?.textContent
                    );

                    const searchText = [
                        name,
                        productCategory,
                        description
                    ].join(' ');

                    const matchSearch =
                        term === '' || searchText.includes(term);

                    const matchCategory =
                        category === 'Semua' ||
                        productCategory === normalize(category);

                    const visible = matchSearch && matchCategory;

                    card.classList.toggle('hidden', !visible);

                    if (visible) count++;
                });

                if (resultCount) {
                    resultCount.textContent = count + ' produk';
                }

                if (emptySearch) {
                    emptySearch.classList.toggle(
                        'hidden',
                        count > 0 || productCards.length === 0
                    );
                }
            }

            // ==========================================
            // 7. SINKRONISASI SEARCH HP & DESKTOP
            // ==========================================


            let searchScrollTimer;

            function updateSearch(value, autoScroll = false) {
                term = normalize(value);

                // Sinkronkan pencarian HP dan desktop
                if (searchTop) searchTop.value = value;
                if (searchMobile) searchMobile.value = value;

                // Filter produk
                filter();

                // Hindari scroll berulang setiap karakter diketik
                clearTimeout(searchScrollTimer);

                if (autoScroll && term.length > 0) {
                    searchScrollTimer = setTimeout(() => {
                        document.getElementById('produk')?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 500);
                }
            }



            [searchTop, searchMobile].forEach(input => {
                if (!input) return;

                input.addEventListener('input', event => {
                    updateSearch(event.target.value, true);
                });
            });


            // ==========================================
            // 8. UPDATE TAMPILAN FILTER KATEGORI
            // ==========================================

            function updateCategoryButtons() {
                categoryButtons.forEach(button => {
                    const active = button.dataset.category === category;

                    button.classList.toggle('border-red-600', active);
                    button.classList.toggle('bg-red-600', active);
                    button.classList.toggle('text-white', active);

                    button.classList.toggle('border-slate-200', !active);
                    button.classList.toggle('bg-white', !active);
                    button.classList.toggle('text-slate-600', !active);

                    button.setAttribute(
                        'aria-pressed',
                        String(active)
                    );
                });
            }

            // ==========================================
            // 9. FILTER KATEGORI
            // ==========================================

            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {

                    category = button.dataset.category;

                    updateCategoryButtons();
                    filter();
                });
            });

            // ==========================================
            // 10. REKOMENDASI PENCARIAN
            // ==========================================

            document.querySelectorAll('[data-search-suggestion]')
                .forEach(button => {

                    button.addEventListener('click', () => {

                        const keyword = button.dataset.searchSuggestion;

                        // Reset filter kategori
                        category = 'Semua';

                        // Isi input dan cari produk
                        updateSearch(keyword);

                        // Perbarui tampilan kategori
                        updateCategoryButtons();

                        // Scroll ke katalog
                        document.getElementById('produk')
                            ?.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                    });
                });

            // ==========================================
            // 11. INISIALISASI
            // ==========================================

            updateCategoryButtons();
            filter();
            render();

            // Jika checkout gagal validasi, tampilkan keranjang kembali
            @if ($errors->any())
                openCart();
            @endif

        })();
    </script>

</x-layouts.app>
