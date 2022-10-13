<!DOCTYPE html>
<html lang="id-ID">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="{{ asset('src/images/logos/favicon.webp')}}" type="image/webp">
    <link rel="icon" href="{{ asset('src/images/logos/favicon.webp')}}" sizes="32x32" type="image/webp">
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png"> --}}
    <meta http-equiv="refresh" content="3600">
    <x-corecss-component />
    {{ $cssPage ?? '' }}
    {{ $titleSlot }}

    <x-third-party-js />
</head>
<body class="animsition">
    
    <x-header-page-component />
    
    {{ $slot }}
    
    <x-footer-page-component />

    <x-corejs-component />
    {{ $jsPage ?? '' }}

    @if (config('app.env') === 'production')
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4SJPW7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
</body>
</html>
