<x-layouts.admin>

    @php
        $isEdit = (bool) $product;
        $pageTitle = $isEdit ? 'Edit Produk' : 'Tambah Produk';
    @endphp

    <!-- Header -->
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-widest text-red-600">
                Product Management
            </p>

            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                {{ $pageTitle }}
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                {{ $isEdit
                    ? 'Perbarui informasi dan harga produk SFStore.'
                    : 'Tambahkan produk digital baru ke katalog SFStore.' }}
            </p>
        </div>

        <a href="{{ route('admin.products') }}"
            class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:text-red-600">
            <span>←</span>
            Kembali ke Produk
        </a>

    </div>

    <!-- Form -->
    <form method="POST" enctype="multipart/form-data"
        action="{{ $isEdit ? route('admin.product.update', $product) : route('admin.product.store') }}"
        class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">

        @csrf

        @if ($isEdit)
            @method('PUT')
        @endif

        <!-- Left Column -->
        <div class="space-y-6 lg:col-span-2">

            <!-- Product Information -->
            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path d="M12 20h9" />
                                <path d="M16 4l4 4-12 12H4v-4z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-900">
                                Informasi Produk
                            </h3>
                            <p class="mt-1 text-xs text-slate-500">
                                Informasi yang ditampilkan kepada pembeli.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="space-y-5 p-5 sm:p-6">

                    <!-- Name -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Produk <span class="text-red-600">*</span>
                        </label>

                        <input type="text" id="name" name="name" required
                            value="{{ old('name', $product?->name) }}" placeholder="Contoh: Template Website Laravel"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">

                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="mb-2 block text-sm font-semibold text-slate-700">
                            Kategori <span class="text-red-600">*</span>
                        </label>

                        <input type="text" id="category" name="category" required list="product-categories"
                            value="{{ old('category', $product?->category) }}" placeholder="Contoh: Source Code"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">

                        <datalist id="product-categories">
                            <option value="Source Code">
                            <option value="E-Book">
                            <option value="Desain">
                            <option value="Template">
                            <option value="Tools">
                        </datalist>

                        @error('category')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi Produk
                        </label>

                        <textarea id="description" name="description" rows="5" placeholder="Jelaskan fitur, isi, dan keunggulan produk..."
                            class="w-full resize-y rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-100">{{ old('description', $product?->description) }}</textarea>

                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </section>

            <!-- Pricing -->
            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <h3 class="font-bold text-slate-900">Harga & Modal</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Tentukan harga penjualan dan modal produk.
                    </p>
                </div>

                <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">

                    @foreach ([['price', 'Harga Jual', true], ['compare_price', 'Harga Coret', false], ['cost', 'Modal Produk', true]] as [$field, $label, $required])
                        <div>
                            <label for="{{ $field }}" class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ $label }}
                                @if ($required)
                                    <span class="text-red-600">*</span>
                                @endif
                            </label>

                            <div
                                class="flex overflow-hidden rounded-xl border border-slate-200 focus-within:border-red-500 focus-within:ring-2 focus-within:ring-red-100">
                                <span class="flex items-center bg-slate-50 px-4 text-sm font-semibold text-slate-500">
                                    Rp
                                </span>

                                <input type="number" id="{{ $field }}" name="{{ $field }}"
                                    min="0" step="1" @if ($required) required @endif
                                    value="{{ old($field, $product?->{$field} ?? ($field === 'cost' ? 0 : '')) }}"
                                    placeholder="0" class="min-w-0 w-full border-0 px-4 py-3 text-sm outline-none">
                            </div>

                            @error($field)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="rounded-xl border border-blue-100 bg-blue-50 p-4 sm:col-span-2">
                        <p class="text-xs leading-relaxed text-blue-700">
                            Harga coret bersifat opsional.
                            Jika digunakan, sebaiknya lebih besar dari harga jual.
                            Modal digunakan untuk menghitung estimasi keuntungan.
                        </p>
                    </div>

                </div>

            </section>

        </div>

        <!-- Right Column -->
        <div class="space-y-6">

            <!-- Product Image -->
            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-5">
                    <h3 class="font-bold text-slate-900">Gambar Produk</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Gunakan gambar yang jelas dan menarik.
                    </p>
                </div>

                <div class="p-5">

                    @php
                        $imageUrl = $product?->image_path ? asset('storage/' . $product->image_path) : null;
                    @endphp

                    <div id="imagePreviewContainer"
                        class="mb-4 flex aspect-square items-center justify-center overflow-hidden rounded-xl border border-dashed border-slate-300 bg-slate-50">

                        <img id="imagePreview" src="{{ $imageUrl ?? '' }}" alt="Preview gambar produk"
                            class="{{ $imageUrl ? '' : 'hidden' }} h-full w-full object-contain">

                        <div id="imagePlaceholder" class="{{ $imageUrl ? 'hidden' : '' }} px-4 text-center">
                            <svg class="mx-auto h-10 w-10 text-slate-300" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <path d="M21 15l-5-5L5 21" />
                            </svg>

                            <p class="mt-2 text-sm text-slate-400">
                                Belum ada gambar
                            </p>
                        </div>

                    </div>

                    <label for="image" class="mb-2 block text-sm font-semibold text-slate-700">
                        Upload Gambar
                    </label>

                    <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp"
                        class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white p-3 text-xs text-slate-600 file:mr-2 file:rounded-lg file:border-0 file:bg-red-50 file:px-3 file:py-2 file:font-semibold file:text-red-600">

                    <p class="mt-2 text-xs text-slate-400">
                        JPG, PNG, WEBP. Maksimal 2 MB.
                    </p>

                    @error('image')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                </div>

            </section>

            <!-- Visibility -->
            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-5">
                    <h3 class="font-bold text-slate-900">Pengaturan Produk</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Atur visibilitas produk di toko.
                    </p>
                </div>

                <div class="space-y-4 p-5">

                    <input type="hidden" name="active" value="0">

                    <label class="flex cursor-pointer items-start gap-3">
                        <input type="checkbox" name="active" value="1" @checked(old('active', $product?->active ?? true))
                            class="mt-1 h-4 w-4 accent-red-600">

                        <span>
                            <span class="block text-sm font-semibold text-slate-800">
                                Tampilkan di Toko
                            </span>
                            <span class="mt-1 block text-xs text-slate-500">
                                Produk dapat dilihat pembeli.
                            </span>
                        </span>
                    </label>

                    <div class="border-t border-slate-100"></div>

                    <input type="hidden" name="featured" value="0">

                    <label class="flex cursor-pointer items-start gap-3">
                        <input type="checkbox" name="featured" value="1" @checked(old('featured', $product?->featured ?? false))
                            class="mt-1 h-4 w-4 accent-red-600">

                        <span>
                            <span class="block text-sm font-semibold text-slate-800">
                                Produk Rekomendasi
                            </span>
                            <span class="mt-1 block text-xs text-slate-500">
                                Tampilkan sebagai produk unggulan.
                            </span>
                        </span>
                    </label>

                </div>

            </section>

            <!-- Submit -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <button type="submit"
                    class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl border border-red-600 bg-red-600 px-5 py-3 font-semibold text-white transition hover:bg-transparent hover:text-red-600">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12l4 4L19 6" />
                    </svg>

                    {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Produk' }}
                </button>

                <a href="{{ route('admin.products') }}"
                    class="mt-3 flex w-full items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>

            </div>

        </div>

    </form>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('image')?.addEventListener('change', function() {
            const file = this.files?.[0];
            if (!file) return;

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                alert('Format gambar harus JPG, PNG, atau WEBP.');
                this.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 2 MB.');
                this.value = '';
                return;
            }

            const image = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');

            if (image.dataset.previewUrl) {
                URL.revokeObjectURL(image.dataset.previewUrl);
            }

            const url = URL.createObjectURL(file);
            image.src = url;
            image.dataset.previewUrl = url;

            image.classList.remove('hidden');
            placeholder.classList.add('hidden');
        });
    </script>

</x-layouts.admin>
