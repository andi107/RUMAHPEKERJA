@if(config('app.env') === 'production')

@else
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('adm/assets/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('adm/assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('adm/assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('adm/assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('adm/assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('adm/assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('adm/assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('adm/assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('adm/assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('adm/assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('adm/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('adm/assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adm/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('adm/assets/favicon/manifest.json') }}">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('adm/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('adm/css/style.css') }}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{ asset('adm/css/examples.css') }}" rel="stylesheet">
    <link href="{{ asset('adm/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
@endif