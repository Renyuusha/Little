<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>Sesuatu Kecil Buat Kamu ♡</title>
    <meta name="description" content="Pojok kecil penuh hal-hal baik.">
    <meta name="theme-color" content="#f8e9e9">

    <meta property="og:title" content="Sesuatu Kecil Buat Kamu ♡">
    <meta property="og:description" content="Pojok kecil penuh hal-hal baik, dibuat khusus buat kamu.">
    <meta property="og:type" content="website">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/encouragement.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-cream text-slate-700 antialiased overflow-x-hidden">
    {{ $slot }}
</body>
</html>
