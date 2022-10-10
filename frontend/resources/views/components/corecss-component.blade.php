@if(config('app.env') === 'production')
{{-- <link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/bootstrap-5/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/animate/animate.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/css-hamburgers/hamburgers.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/animsition/css/animsition.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/css/util.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/css/main.min.css')}}"> --}}
@endif

<link rel="stylesheet" href="{{asset('src/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('src/plugins/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('src/plugins/slick-carousel/slick.min.css')}}">
<link rel="stylesheet" href="{{asset('src/plugins/slick-carousel/slick-theme.min.css')}}">
<link rel="stylesheet" href="{{asset('anim/css/animsition.min.css')}}">

<link rel="stylesheet" href="{{asset('src/css/style.css')}}">

<style>
    .logo_img_size {
        height: 100%;
        width: -webkit-fill-available;
    }
    .footer_logo_img_size{
        height: 73px;
        width: 159px;
    }
    #attach_img_size {
        width:90%;
        max-width:600px;
    }
</style>