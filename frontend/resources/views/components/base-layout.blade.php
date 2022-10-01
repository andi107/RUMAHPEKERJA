<!DOCTYPE html>
<html lang="id-ID">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('src/images/icons/favicon.png')}}" />
    
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
    @endif
</head>
<body class="animsition">
    <!-- Header -->
    <x-header-page-component />
    <!-- Content -->
    {{ $slot }}
    <!-- Footer -->
    <x-footer-page-component />

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>
    <x-corejs-component />
    {{ $jsPage ?? '' }}

    @if (config('app.env') === 'production')
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4SJPW7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
</body>
</html>
