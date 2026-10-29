<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#dc2626">

    <meta name="description"
        content="SFStore - Toko produk digital, source code, e-book, template, dan kebutuhan digital lainnya.">

    <title>{{ $title ?? 'SFStore - Produk Digital' }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">

    <!-- Main Content -->
    <main id="main-content" class="min-h-screen">

        {{ $slot }}

    </main>

    @stack('scripts')

</body>

</html>
