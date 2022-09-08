@if(config('app.env') === 'production')
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/animate/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/css/util.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ secure_asset('src/css/main.css')}}">
@else
    <link rel="stylesheet" type="text/css" href="{{ asset('src/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/vendor/animate/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/css/util.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/css/main.css')}}">
@endif

<style>
    
</style>
