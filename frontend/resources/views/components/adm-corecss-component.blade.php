@if(config('app.env') === 'production')
<link rel="apple-touch-icon" sizes="57x57" href="{{ secure_asset('adm/assets/favicon/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ secure_asset('adm/assets/favicon/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ secure_asset('adm/assets/favicon/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ secure_asset('adm/assets/favicon/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ secure_asset('adm/assets/favicon/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ secure_asset('adm/assets/favicon/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ secure_asset('adm/assets/favicon/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ secure_asset('adm/assets/favicon/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('adm/assets/favicon/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ secure_asset('adm/assets/favicon/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('adm/assets/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ secure_asset('adm/assets/favicon/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('adm/assets/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ secure_asset('adm/assets/favicon/manifest.json') }}">
<link rel="stylesheet" href="{{ secure_asset('adm/vendors/simplebar/css/simplebar.css') }}">
<link rel="stylesheet" href="{{ secure_asset('adm/css/vendors/simplebar.css') }}">
<link href="{{ secure_asset('adm/css/style.css') }}" rel="stylesheet">
<link href="{{ secure_asset('adm/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
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
<link rel="stylesheet" href="{{ asset('adm/vendors/simplebar/css/simplebar.css') }}">
<link rel="stylesheet" href="{{ asset('adm/css/vendors/simplebar.css') }}">
<link href="{{ asset('adm/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('adm/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
@endif

<style>
</style>
