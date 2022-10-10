<!DOCTYPE html>
<html lang="id-ID">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="{{ asset('src/images/logos/favicon.webp')}}" type="image/webp">
    <link rel="icon" href="{{ asset('src/images/logos/favicon.webp')}}" type="image/webp">
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png"> --}}
    

    {!! $seometa::generate() !!}

    <x-corecss-component />
    {{ $cssPage ?? '' }}
    {{ $titleSlot }}

    @if (config('app.env') === 'production')
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime()
                    , event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0]
                    , j = d.createElement(s)
                    , dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-T4SJPW7');

        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XB7PG0P5TG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-XB7PG0P5TG');

        </script>
        <script src="https://www.googleoptimize.com/optimize.js?id=OPT-5F792S9"></script>
    @endif
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
