<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('src/images/icons/favicon.png')}}" />
    <x-corecss-component />
    {{ $cssPage ?? '' }}
    {{ $titleSlot }}

    @if (config('app.env') === 'production')
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
</body>
</html>
