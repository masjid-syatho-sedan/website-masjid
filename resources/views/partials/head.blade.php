<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="language" content="id-ID" />
<meta http-equiv="Content-Language" content="id-ID" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/manifest.json">

{{-- PWA meta tags --}}
<meta name="theme-color" content="#b45309">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Masjid Syatho">

<meta name="description" content="Website Masjid Syatho Sedan - Melayani umat dengan sepenuh hati" />
<meta name="keywords" content="masjid, jadwal shalat, kajian Islam, komunitas Muslim" />
<meta name="google-site-verification" content="rnppDMJTkKP3WB3d2T3YZLJi3yfnCuRT_lIpLLNkCC8" />

{{-- Open Graph (default, dapat di-override per halaman via @push('og-meta')) --}}
<meta property="og:site_name" content="Masjid Syatho Sedan" />
<meta property="og:locale" content="id_ID" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:title" content="{{ filled($title ?? null) ? $title.' - Masjid Syatho Sedan' : 'Masjid Syatho Sedan' }}" />
<meta property="og:description" content="Website Masjid Syatho Sedan - Melayani umat dengan sepenuh hati" />
@stack('og-meta')

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
